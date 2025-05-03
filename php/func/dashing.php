<?php
include '../connection.php';
header('Content-Type: application/json');
try {
    $results = [];
    $sqlWeeklySales = "SELECT SUM(total) as weekly_sales 
                        FROM transactions 
                        WHERE Date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
    $results['weekly_sales'] = $conn->query($sqlWeeklySales)->fetch(PDO::FETCH_ASSOC)['weekly_sales'] ?? 0;
    $sqlMonthlySales = "SELECT SUM(total) as monthly_sales 
                        FROM transactions 
                        WHERE Date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
    $results['monthly_sales'] = $conn->query($sqlMonthlySales)->fetch(PDO::FETCH_ASSOC)['monthly_sales'] ?? 0;
    $sqlYearlySales = "SELECT SUM(total) as yearly_sales 
                        FROM transactions 
                        WHERE Date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
    $results['yearly_sales'] = $conn->query($sqlYearlySales)->fetch(PDO::FETCH_ASSOC)['yearly_sales'] ?? 0;

    // Monthly Expenses
    $sqlMonthlyExpenses = "SELECT SUM(price * quantity) as monthly_expenses 
                           FROM entries 
                           WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
    $results['monthly_expenses'] = $conn->query($sqlMonthlyExpenses)->fetch(PDO::FETCH_ASSOC)['monthly_expenses'] ?? 0;

    // // Weekly Difference (Sales - Expenses)
    // $results['weekly_difference'] = $results['weekly_sales'];

    // // Monthly Difference (Sales - Expenses)
    // $results['monthly_difference'] = $results['monthly_sales'] - $results['monthly_expenses'];

    // // Yearly Difference (Sales - Expenses)
    // $results['yearly_difference'] = $results['yearly_sales'];

    echo json_encode($results);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>