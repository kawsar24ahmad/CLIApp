<?php

namespace App;

class FinanceManager {
    private $filename = "transactionFile.php";

    private array $categories = [
        1 => ['category' => 'Business', 'type' => 'Income'],
        2 => ['category' => 'Food', 'type' => 'Expense'],
        3 => ['category' => 'Family', 'type' => 'Expense'],
        4 => ['category' => 'Tuition', 'type' => 'Expense'],
        5 => ['category' => 'Teaching', 'type' => 'Income'],
        6 => ['category' => 'Other Category', 'type' => 'Custom Type']
    ];

    public function addIncome() {

        $amount =  number_format((float)trim(readline("Enter income amount: ")), 2,'.', '');

        while (empty($amount)|(!is_numeric($amount))|$amount <= 0) {
            echo "You must give a valid income amount:\n";
            $amount =  number_format((float)trim(readline("Enter income amount: ")), 2,'.', '');
        }

        
        $results = [];
        foreach ($this->categories as $key => $value) {
            $results[] =  $value;
        }
        foreach ($results as $key => $value) {
            echo $key +1 . '.' . $value['category'] .','. $value['type']  ."\n";
        }
        $choice = intval(readline("Enter your option: "));
        while (empty($choice)|(!is_numeric($choice))|$choice <= 0 | $choice > $key +=1 ) {
            echo "You must give a valid option:\n";
            $choice = intval(readline("Enter your option: "));
        }
        switch ($choice) {
            case 1:
                $category = $results[0]['category'];
                $type = $results[0]['type'];
                break;
            case 2:
                $category = $results[1]['category'];
                $type = $results[1]['type'];
                break;
            case 3:
                $category = $results[2]['category'];
                $type = $results[2]['type'];
                break;
            case 4:
                $category = $results[3]['category'];
                $type = $results[3]['type'];
                break;
            case 5:
                $category = $results[4]['category'];
                $type = $results[4]['type'];
                break;
            case 6:
                $category = trim(readline("Enter custom category name: "));
                while (empty($category)|(is_numeric($category))) {
                    echo "You must give a valid category name:\n";
                    $category = trim(readline("Enter custom category name: "));
                }
                $type = trim(readline("Enter custom category type (Income/Expense): "));
                while (empty($type) || (!is_numeric($type) && !in_array(strtolower($type), ["income", "expense"]))) {
                    echo "You must give a valid type name:(Income/Expense)\n";
                    $type = trim(readline("Enter custom category name: "));
                }
                
                break;
            
            default:
                $category = "unknown";
                $type = "unknown";
                echo "Invalid option. \n";
                break;
        }


        if (file_exists($this->filename)) {
            $data = json_encode(['amount' => $amount, 'category' => $category, 'type' => $type]) . "\n";
            file_put_contents($this->filename, $data, FILE_APPEND);
            if ($category == "unknown" && $type == "unknown") {
                echo "unknown amount added!\n";
                return;
            }
            echo "{$type} added successfully!\n";
        } else {
            echo 'This file does not exist!';
        }
    }

    public function addExpense() {
        $amount =  number_format((float)trim(readline("Enter income amount: ")), 2,'.', '');

        while (empty($amount)|(!is_numeric($amount))|$amount <= 0) {
            echo "You must give a valid income amount:\n";
            $amount =  number_format((float)trim(readline("Enter income amount: ")), 2,'.', '');
        }
        
        $expenses = [];
        foreach ($this->categories as $key => $value) {
            $expenses[] =  $value;
        }
        foreach ($expenses as $key => $value) {
            echo $key +1 . '.' . $value['category'] .','. $value['type']  ."\n";
        }
        // var_dump($results);
        $choice = intval(readline("Enter your option: "));
        while (empty($choice)|(!is_numeric($choice))|$choice <= 0 | $choice > $key +=1 ) {
            echo "You must give a valid option:\n";
            $choice = intval(readline("Enter your option: "));
        }
        switch ($choice) {
            case 1:
                $category = $expenses[0]['category'];
                $type = $expenses[0]['type'];
                break;
            case 2:
                $category = $expenses[1]['category'];
                $type = $expenses[1]['type'];
                break;
            case 3:
                $category = $expenses[2]['category'];
                $type = $expenses[2]['type'];
                break;
            case 4:
                $category = $expenses[3]['category'];
                $type = $expenses[3]['type'];
                break;
            case 5:
                $category = $expenses[4]['category'];
                $type = $expenses[4]['type'];
                break;
            case 6:
                $category = trim(readline("Enter custom category name: "));
                while (empty($category)|(is_numeric($category))) {
                    echo "You must give a valid category name:\n";
                    $category = trim(readline("Enter custom category name: "));
                }
                $type = trim(readline("Enter custom category type (Income/Expense): "));
                while (empty($type) || (!is_numeric($type) && !in_array(strtolower($type), ["income", "expense"]))) {
                    echo "You must give a valid type name:(Income/Expense)\n";
                    $type = trim(readline("Enter custom category name: "));
                }
                break;
            
            default:
                $category = "unknown";
                $type = "unknown";
                echo "Invalid option. \n";
                break;
        }
        if (file_exists($this->filename)) {
            $data = json_encode(['amount' => $amount, 'category' => $category, 'type' => $type]) . "\n";
            file_put_contents($this->filename, $data, FILE_APPEND);
            if ($category == "unknown" && $type == "unknown") {
                echo "unknown amount added!\n";
                return;
            }
            echo "{$type} added successfully!\n";
        } else {
            echo 'This file does not exist!';
        }
    }

    public function showIncomes() {
        if (file_exists($this->filename)) {
            $lines = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $incomes = [];
            $hasIncomes = false;
    
            foreach ($lines as $line) {
                $incomes[] = json_decode($line, true);
            }
    
            foreach ($incomes as $income) {
                if (strtolower($income['type']) == 'income') {
                    echo "Amount: {$income['amount']}\n";
                    $hasIncomes = true; // Set the flag to true if there is at least one income
                }
            }
    
            if (!$hasIncomes) {
                echo "No incomes\n";
            }
        } else {
            echo 'This file does not exist!';
        }
    }
    

    public function showExpense() {
        if (file_exists($this->filename)) {
            $lines = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $expenses = [];
            $hasExpense = false;
            foreach ($lines as $line) {
                $expenses[] = json_decode($line, true);
            }
           
            foreach ($expenses as $expense) {
                if (strtolower($expense['type']) == 'expense') {
                    echo "Amount: {$expense['amount']}\n";
                    $hasExpense = true;
                }
            }
            if (!$hasExpense) {
                echo "No Expense!\n";
            }

        } else {
            echo 'This file does not exist!';
        }
    }

    public function viewCategories()  {
        $all_categories=[];
        foreach ($this->categories as $category) {
            $all_categories[]=  $category;
            
        }
        foreach ($all_categories as $category) {
            echo "Category: {$category['category']}, Type: {$category['type']}\n";
        }
    }

    public function totalIncome() {
        if (file_exists($this->filename)) {
            $lines = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $incomes = [];
            foreach ($lines as $line) {
                $incomes[] = json_decode($line, true);
            }
            $amount = 0;
            foreach ($incomes as $income) {
                if ($income['type'] == 'Income') {
                    $amount += $income['amount'];
                }
            }
            return $amount;
        } else {
            echo 'This file does not exist!';
        }
    }

    public function totalExpense() {
        if (file_exists($this->filename)) {
            $lines = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $expenses = [];
            foreach ($lines as $line) {
                $expenses[] = json_decode($line, true);
            }
            $amount = 0;
            foreach ($expenses as $expense) {
                if ($expense['type'] == 'Expense') {
                    $amount += $expense['amount'];
                }
            }
            return $amount;
        } else {
            echo 'This file does not exist!';
        }
    }

    public function showSavings() {
        $income = $this->totalIncome();
        $expense = $this->totalExpense();
        $savings = $income - $expense;
        return $savings;
    }

  
}
