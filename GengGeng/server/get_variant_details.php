<?php
session_start();
include('connection.php');

if (isset($_GET['variant_id'])) {
    $variant_id = $_GET['variant_id'];

    // Fetch variant details
    $variantDetailsQuery = $conn->query("SELECT * FROM variants WHERE variant_id = $variant_id");

    if ($variantDetailsQuery) {
        $variantDetails = $variantDetailsQuery->fetch_assoc();

        $variant_image = isset($variantDetails['image']) ? $variantDetails['image'] : null;
        $variant_name = isset($variantDetails['variant_name']) ? $variantDetails['variant_name'] : null;
        $variant_price = isset($variantDetails['variant_price']) ? $variantDetails['variant_price'] : null;

        $response = [
            'image' => $variant_image,
            'variant_name' => $variant_name,
            'variant_price' => $variant_price,
        ];

        // Log the response data for debugging
        error_log('Response Data: ' . json_encode($response));

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Log the error for debugging
        error_log('Failed to fetch variant details');

        header('Content-Type: application/json');
        echo json_encode(['error' => 'Failed to fetch variant details']);
    }
} else {
    // Log the error for debugging
    error_log('Variant ID not provided');

    header('Content-Type: application/json');
    echo json_encode(['error' => 'Variant ID not provided']);
}
?>