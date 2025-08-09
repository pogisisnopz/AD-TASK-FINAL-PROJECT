<?php
// cart.php

include 'db.php'; // Include the database connection file

// CREATE function - Add an item to the cart
function add_to_cart($user_id, $product_id, $quantity) {
    global $pdo;
    try {
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
        echo "Item added to cart successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// READ function - Get all items in the cart for a specific user
function get_cart_items($user_id) {
    global $pdo;
    try {
        $sql = "SELECT * FROM cart WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cart_items;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// UPDATE function - Update the quantity of an item in the cart
function update_cart_item($cart_id, $quantity) {
    global $pdo;
    try {
        $sql = "UPDATE cart SET quantity = :quantity, updated_at = CURRENT_TIMESTAMP WHERE cart_id = :cart_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
        echo "Cart item updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// DELETE function - Remove an item from the cart
function remove_from_cart($cart_id) {
    global $pdo;
    try {
        $sql = "DELETE FROM cart WHERE cart_id = :cart_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->execute();
        echo "Cart item removed successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
