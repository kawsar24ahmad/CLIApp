<?php
namespace App;
use App\FinanceManager;
class CLIApp
{
    private FinanceManager $financeManager;
    
    private const ADD_INCOME = 1;
    private const ADD_EXPENSE = 2;
    private const VIEW_INCOME = 3;
    private const VIEW_EXPENSE = 4;
    private const VIEW_SAVINGS = 5;
    private const VIEW_CATEGORIES = 6;
    private const VIEW_TOTAL_INCOME = 7;
    private const VIEW_TOTAL_EXPENSE = 8;
    private const EXIT_APP = 9;

    private array $options = [
        self::ADD_INCOME => 'Add income',
        self::ADD_EXPENSE => 'Add expense',
        self::VIEW_INCOME => 'View income',
        self::VIEW_EXPENSE => 'View expense',
        self::VIEW_SAVINGS => 'View savings',
        self::VIEW_CATEGORIES => 'View categories',
        self::VIEW_TOTAL_INCOME => 'View total income',
        self::VIEW_TOTAL_EXPENSE => 'View total expense',
        self::EXIT_APP => 'Exit'

    ];
  
    public function __construct()  {
        $this->financeManager = new FinanceManager();
    }

    public function run()  {
        while (true) {
            foreach ($this->options as $option => $label) {
                printf("%d. %s\n", $option, $label);
            }
            $choice = intval(readline("Enter your option: "));
            switch ($choice) {
                case self::ADD_INCOME:
                    echo "adding income\n";
                    $this->financeManager->addIncome();
                    break;
                case self::ADD_EXPENSE:
                    echo "adding EXPENSE\n";
                    $this->financeManager->addExpense();
                    break;
                case self::VIEW_INCOME:
                    echo "Viewing income\n";
                    $this->financeManager->showIncomes();
                    break;
                case self::VIEW_EXPENSE:
                    echo "Viewing expense\n";
                    $this->financeManager->showExpense();
                    break;
                case self::VIEW_SAVINGS:
                    echo "Viewing savings\n";
                    $amount = $this->financeManager->showSavings();
                    echo "Total Savings: {$amount}\n";
                    break;
                
                case self::VIEW_CATEGORIES:
                    
                    $this->financeManager->viewCategories();
                    break;
                case self::VIEW_TOTAL_INCOME:
                    echo "Viewing total income\n";
                    $amount = $this->financeManager->totalIncome();
                    echo "Total Income: {$amount}\n";
                    break;
                case self::VIEW_TOTAL_EXPENSE:
                    echo "Viewing total expense\n";
                    $amount = $this->financeManager->totalExpense();
                    echo "Total Expense: {$amount}\n";
                    break;
                case self::EXIT_APP:
                    return;
                
                default:
                    echo "Invalid option. \n";
            }
        }
    
    }
    
}