<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(
            Product::query()->latest()->paginate(),
        );
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return (new ProductResource($product))
            ->additional(['message' => 'Product created successfully.'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $product->update([
            ...$request->validated(),
            'updated_by' => $request->user()->id,
        ]);

        return (new ProductResource($product->refresh()))
            ->additional(['message' => 'Product updated successfully.']);
    }

    public function destroy(Product $product): JsonResponse
    {
        if ($product->batches()->exists() || $product->orderItems()->exists()) {
            return response()->json([
                'message' => 'This product cannot be deleted because it is used by batches or order items.',
            ], 409);
        }

        $product->delete();

        return response()->json(null, 204);
    }

    public function export(Request $request): StreamedResponse
    {
        $validated = $request->validate([
            'format' => ['sometimes', Rule::in(['csv', 'excel'])],
        ]);

        $format = $validated['format'] ?? 'csv';
        $baseFilename = 'Product_'.now()->format('Y-m-d');

        if ($format === 'excel') {
            return $this->exportExcel("{$baseFilename}.xls");
        }

        return $this->exportCsv("{$baseFilename}.csv");
    }

    private function exportCsv(string $filename): StreamedResponse
    {
        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                return;
            }

            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $this->exportHeaders());

            Product::query()
                ->orderBy('id')
                ->chunk(200, function ($products) use ($handle): void {
                    foreach ($products as $product) {
                        fputcsv($handle, $this->exportRow($product));
                    }
                });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function exportExcel(string $filename): StreamedResponse
    {
        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                return;
            }

            fwrite($handle, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
            fwrite($handle, "<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\">\n");
            fwrite($handle, "<Worksheet ss:Name=\"Products\">\n<Table>\n");
            fwrite($handle, $this->excelRow($this->exportHeaders()));

            Product::query()
                ->orderBy('id')
                ->chunk(200, function ($products) use ($handle): void {
                    foreach ($products as $product) {
                        fwrite($handle, $this->excelRow($this->exportRow($product)));
                    }
                });

            fwrite($handle, "</Table>\n</Worksheet>\n</Workbook>\n");
            fclose($handle);
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    /**
     * @return list<string>
     */
    private function exportHeaders(): array
    {
        return [
            'ID',
            'Product Code',
            'Product Name',
            'Product Type',
            'Grade',
            'Description',
            'Price Per Kg',
            'Image URL',
            'Is Active',
            'Updated By',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * @return list<int|string|null>
     */
    private function exportRow(Product $product): array
    {
        return [
            $product->id,
            $product->product_code,
            $product->product_name,
            $product->product_type,
            $product->grade,
            $product->description,
            $product->price_per_kg,
            $product->image_url,
            $product->is_active ? 'Yes' : 'No',
            $product->updated_by,
            $product->created_at?->toDateTimeString(),
            $product->updated_at?->toDateTimeString(),
        ];
    }

    /**
     * @param  list<int|string|null>  $values
     */
    private function excelRow(array $values): string
    {
        $cells = array_map(static function (int|string|null $value): string {
            if (is_int($value)) {
                return "<Cell><Data ss:Type=\"Number\">{$value}</Data></Cell>";
            }

            $escaped = htmlspecialchars((string) ($value ?? ''), ENT_XML1 | ENT_QUOTES, 'UTF-8');

            return "<Cell><Data ss:Type=\"String\">{$escaped}</Data></Cell>";
        }, $values);

        return '<Row>'.implode('', $cells)."</Row>\n";
    }
}
