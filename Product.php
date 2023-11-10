<?php
class Product{
    private float $averageRating;
    private array $images;
    private string $meetingPoint;

    public function setAverageRating(float $averageRating):void{
        $this->averageRating = $averageRating;

    }
    public function setImages(array $images):void{
        $this->images = $images;
    }
    public function setMeetingPoint(string $meetingPoint):void{
        $this->meetingPoint = $meetingPoint;
    }
    public function toJson():string{
        $data = [
            "averageRating" => $this->averageRating,
            "images" => $this->images,
            "meetingPoint" => $this->meetingPoint,
        ];
        return json_encode($data);
    }
}

function parseProduct($products){

    $product = new Product();
    $averageRating = calculateAverageRating($products['reviews']);
    $product->setAverageRating($averageRating);
    $largestVariants = calculateLargest($products);
    $product->setImages($largestVariants);
    $meetingPoint = setMeetingPoint($products);
    $product->setMeetingPoint($meetingPoint);
    return $product;

}
function calculateAverageRating($reviews) {

    $totalReviews = 0;
    $totalRatings = 0;
    if(isset($reviews['reviewCountTotals'])){
        foreach ($reviews['reviewCountTotals'] as $key => $value) {
            $totalReviews += $value['count'];
            $totalRatings += $value['rating'];
        }
    }else{
        return 0.00;
    }
    
    $averageRating = $totalRatings / $totalReviews;
    return round($averageRating, 2);
}

function calculateLargest($productData){
    if (isset($productData['images']) && is_array($productData['images'])) {
        $largestVariants = [];
        foreach ($productData['images'] as $imageData) {
            $largestWidth = 0;
            $largestVariantURL = '';

            if (isset($imageData['variants']) && is_array($imageData['variants'])) {
                foreach ($imageData['variants'] as $variant) {
                    if (isset($variant['width']) && $variant['width'] > $largestWidth) {
                        $largestWidth = $variant['width'];
                        $largestVariantURL = $variant['url'];
                    }
                }
            }

            $largestVariants[] = $largestVariantURL;
        }

    }
    return $largestVariants;

}
function setMeetingPoint($productData){
    $meetingPoint = '';
    if (isset($productData['description'])) {
        $description = $productData['description'];
        $pattern = '/Meeting point: (.*?)\n\n/';
        if (preg_match($pattern, $description, $matches)) {
            $meetingPoint = ucfirst($matches[1]);
        }
    }
    return $meetingPoint;
}

$path = 'products.json';
$jsonString = file_get_contents($path);
$jsonData = json_decode($jsonString, true);

if (isset($jsonData['products']) && is_array($jsonData['products'])) {
    foreach ($jsonData['products'] as $productData) {
        if (isset($productData['status']) && $productData['status'] === 'ACTIVE') {
            $product = parseProduct($productData);
            echo $product->toJSON() . PHP_EOL;
        }
    }
}
?>
