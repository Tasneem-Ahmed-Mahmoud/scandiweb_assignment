<?php
namespace App\Core;

use Exception;

class Validator
{
    private $errors = [];
    private $inputs = [];
    private const PREFIX_FUNC = "validate_";
    private $currentRuleValue = null;
    private static $sharedErrors = [];

    public function __construct(array $data)
    {
        $this->inputs = $this->sanitizeInputs($data);
        extract($this->inputs);
    }

    public static function check(array $data, array $rules): bool
    {
        $instance = new self($data);
        foreach ($rules as $name => $ruleSet) {
           
            $ruleArray = $instance->getRules($ruleSet);
         
            foreach ($ruleArray as $rule) {
                if (strpos($rule, ":")) {
                    [$rule, $instance->currentRuleValue] = explode(":", $rule);
                  
                }
                if (isset($instance->errors[$name])) {
                    continue;
                }
                $method = self::PREFIX_FUNC . $rule;
                if (!method_exists($instance, $method)) {
                    throw new Exception("{$rule} rule does not exist");
                } else {
                    if ($rule === "in_array") {
                       
                        $instance->$method($name, explode(",", $instance->currentRuleValue));
                    } else {
                        $instance->$method($name);
                    }
                }
            }
        }
        self::$sharedErrors = $instance->errors;
        return empty($instance->errors);
    }

    public static function getErrors(): array
    {
        return self::$sharedErrors;
    }

    private function getRules(string $rules): array
    {
        return explode("|", $rules);
    }

    private function sanitizeInputs(array $data): array
    {
        $sanitized = [];
        foreach ($data as $name => $value) {
            $sanitized[$name] = htmlspecialchars(trim($value));
        }
        return $sanitized;
    }

    public function validated(): array
    {
        return $this->inputs;
    }
    
    private function validate_required(string $name): void
    {
        if (empty($this->inputs[$name])) {
            $this->errors[$name] = "{$name} is required";
        }
    }

    private function validate_email(string $name): void
    {
        if (!filter_var($this->inputs[$name], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$name] = "{$name} must be a valid email";
        }
    }

    private function validate_string(string $name): void
    {
        if (!preg_match("/^[a-zA-Z .]+$/", $this->inputs[$name])) {
            $this->errors[$name] = "{$name} must be a string";
        }
    }

    private function validate_min(string $name): void
    {
        if (strlen($this->inputs[$name]) < (int) $this->currentRuleValue) {
            $this->errors[$name] = "{$name} must be at least " . $this->currentRuleValue . " characters long";
        }
    }

    private function validate_max(string $name): void
    {
        if (strlen($this->inputs[$name]) > (int) $this->currentRuleValue) {
            $this->errors[$name] = "{$name} must be no more than " . $this->currentRuleValue . " characters long";
        }
    }

    private function validate_float(string $name): void
    {
        if (!filter_var($this->inputs[$name], FILTER_VALIDATE_FLOAT)) {
            $this->errors[$name] = "{$name} must be a float";
        }
    }

    private function validate_numeric(string $name): void
    {
        if (!filter_var($this->inputs[$name], FILTER_VALIDATE_INT)) {
            $this->errors[$name] = "{$name} must be a number";
        }
    }

    private function validate_in_array(string $name, array $array): void
    {
        if (!in_array($this->inputs[$name], $array)) {
            $this->errors[$name] = "{$name} must be one of the following values: " . implode(", ", $array);
        }
    }


    private function validate_unique(string $name): void
    {
       
        $conn = new DB();
        $result = $conn->setTable('products')->where(["$name" => $this->inputs[$name]])->select()->getResult();
        // var_dump($result);
        // die;
        if (!empty($result)) {
            $this->errors[$name] = "{$name} must be unique";
        }
    }
}

// $_POST = [
//     "name" => "Jn",
//     "email" => "gmail@w.com",
//     "role"=>"sara"
// ];

// try {
//     $isValid = Validator::check($_POST, [
//          'role' => 'required|in_array:admin,user,guest',
//         'name' => 'required|min:5|string',
//         'email' => 'required|email|max:50'
       
//     ]);

//     if (!$isValid) {
//         throw new Exception("Validation failed");
//     }
// } catch (Exception $e) {
//     echo "Validation Exception: " . $e->getMessage();
// }

// echo "<pre>";
// var_dump(Validator::getErrors());

?>
