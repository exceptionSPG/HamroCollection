<?php

declare(strict_types=1);

namespace App;

use Exception;

class ProductSimilarity
{
    protected $products       = [];
    protected $featureWeight  = 1;
    protected $priceWeight    = 1;
    protected $categoryWeight = 1;
    protected $priceHighRange = 10000;

    public function __construct(array $products)
    {
        $this->products       = $products;
        $this->priceHighRange = max(array_column($products, 'selling_price'));
    }

    public function setFeatureWeight(float $weight): void
    {
        $this->featureWeight = $weight;
    }

    public function setPriceWeight(float $weight): void
    {
        $this->priceWeight = $weight;
    }

    public function setCategoryWeight(float $weight): void
    {
        $this->categoryWeight = $weight;
    }

    public function calculateSimilarityMatrix(): array
    {
        $matrix = [];

        foreach ($this->products as $product) {

            $similarityScores = [];

            foreach ($this->products as $_product) {
                if ($product['id'] === $_product['id']) {
                    continue;
                }
                $similarityScores['product_id_' . $_product['id']] = $this->calculateSimilarityScore($product, $_product);
            }
            $matrix['product_id_' . $product['id']] = $similarityScores;
        }
        return $matrix;
    }

    public function getProductsSortedBySimularity(int $productId, array $matrix): array
    {
        $similarities   = $matrix['product_id_' . $productId] ?? null;
        $sortedProducts = [];

        if (is_null($similarities)) {
            throw new Exception('Can\'t find product with that ID.');
        }
        arsort($similarities);

        foreach ($similarities as $productIdKey => $similarity) {
            $id       = intval(str_replace('product_id_', '', $productIdKey));
            $products = array_filter($this->products, function ($product) use ($id) {
                return $product['id'] === $id;
            });
            if (!count($products)) {
                continue;
            }
            $product = $products[array_keys($products)[0]];
            $product['similarity'] = $similarity - 0.02;
            $sortedProducts[] = $product;
        }
        return $sortedProducts;
    }

    protected function calculateSimilarityScore($productA, $productB)
    {
        $paFArray = array_map('intval', explode(',', $productA['product_tags_en']));
        $pbFArray = array_map('intval', explode(',', $productB['product_tags_en']));
        $productAFeatures = implode('', $paFArray);
        $productBFeatures = implode('', $pbFArray);

        return array_sum([
            (Similarity::hamming($productAFeatures, $productBFeatures) * $this->featureWeight),
            (Similarity::euclidean(
                Similarity::minMaxNorm([$productA['selling_price']], 0, $this->priceHighRange),
                Similarity::minMaxNorm([$productB['selling_price']], 0, $this->priceHighRange)
            ) * $this->priceWeight),
            (Similarity::jaccard($productA['category']['category_name_en'], $productB['category']['category_name_en']) * $this->categoryWeight)
        ]) / ($this->featureWeight + $this->priceWeight + $this->categoryWeight);
    }
}
