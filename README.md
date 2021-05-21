## Validator

<p align="center">
  <img src="logo.jpg" width="400px" alt="Validator Logo">
</p>

  Validator is a server side data validation library for PHP. Validate html form-data, objects, arrays and json etc. Validator make data validation simple.

### Installation

  - Install `composer` if you have not installed.

```shell
composer require unicframework/validator
```

### Set Validation Rules

  We can set data validation rules using `rules` method.

```php
use Validator\Validator;

// Set data validation rules
$validator = Validator::make([
  'first_name' => [
    'required' => true,
    'not_null' => true,
    'string' => true
  ],
  'last_name' => [
    'required' => true,
    'not_null' => true,
    'string' => true
  ],
  'email' => [
    'required' => true,
    'not_null' => true,
    'email' => true
  ],
  'gender' => [
    'required' => true,
    'not_null' => true,
    'in' => ['male', 'female']
  ],
  'password' => [
    'required' => true,
    'not_null' => true,
    'minlength' => 6
  ]
]);
```

We can also use a shorthand method to set data validation rules, which is very simple and shorter.

```php
use Validator\Validator;

// Set data validation rules
$validator = Validator::make([
  'first_name,last_name' => 'required|not_null|string',
  'email' => 'required|not_null|email',
  'gender' => 'required|not_null|in:male,female',
  'password' => 'required|not_null|minlength:6'
]);
```

### Set Error Messages

  We can set error messages using `messages` method. if we don't set error messages then validator automatically generate error messages for you.

```php
use Validator\Validator;

// Set validation error messages
$validator = Validator::make([
  'first_name' => [
    'required' => true,
    'not_null' => true,
    'string' => true
  ],
  'last_name' => [
    'required' => true,
    'not_null' => true,
    'string' => true
  ],
  'email' => [
    'required' => true,
    'not_null' => true,
    'email' => true
  ],
  'gender' => [
    'required' => true,
    'not_null' => true,
    'in' => ['male', 'female']
  ],
  'password' => [
    'required' => true,
    'not_null' => true,
    'minlength' => 6
  ]
],
[
  'first_name' => [
    'required' => 'First name is required',
    'not_null' => 'First name can not be null',
    'string' => 'First name should be in string'
  ],
  'last_name' => [
    'required' => 'Last name is required',
    'not_null' => 'Last name can not be null',
    'string' => 'Last name should be in string'
  ],
  'email' => [
    'required' => 'Email is required',
    'not_null' => 'Email can not be null',
    'email' => 'Please enter valid email address'
  ],
  'gender' => [
    'required' => 'Gender is required',
    'not_null' => 'Gender can not be null',
    'in' => 'Please select valid gender'
  ],
  'password' => [
    'required' => 'Password is required',
    'not_null' => 'Password can not be null',
    'minlength' => 'Password length should be minimum 5 characters'
  ]
]);
```

We can also use a shorthand method to set data validation rules, which is very simple and shorter.

```php
use Validator\Validator;

// Set validation error messages
$validator = Validator::make([
  'first_name,last_name' => 'required|not_null|string',
  'email' => 'required|not_null|email',
  'gender' => 'required|not_null|in:male,female',
  'password' => 'required|not_null|minlength:6'
],
[
  'first_name,last_name' => 'required:Name is required|not_null:Name can not be null|string:Name should be in string',
  'email' => 'required:Email is required|not_null:Email can not be null|email:Please enter valid email address',
  'gender' => 'required:Gender is required|not_null:Gender can not be null|in:Please select valid gender'
  'password' => 'required: Password is required|not_null:Password can not be null|minlength:Password length should be minimum 5 characters',
]);
```

### Validate Data
  Using validator we can validate html form-data, array, object and json data. Validator validate data according to rules. It will return `true` if all the data are valid, otherwise it will return `false`.

  #### Validate single data :

```php
use Validator\Validator;

$validator = Validator::make([
  'name' => [
    'required' => true,
    'not_null' => true,
    'string' => true
  ],
  'gender' => [
    'required' => true,
    'not_null' => true,
    'string' => true,
    'lowercase' => true,
    'in' => ['male', 'female', 'other']
  ],
  'contact.email' => [
    'required' => true,
    'not_null' => true,
    'email' => true,
  ]
],
[
  'contact.email' => [
    'required' => 'Please enter email address.',
    'email' => 'Please enter valid email address.'
  ]
]);

// Data for validation
// We can validate any data like arrays, objects, and json etc.
$data = [
  'name' => 'abc xyz',
  'gender' => 'male',
  'contact' => [
    'email' => 'abc@gmail.com'
  ]
];

// Validate data
if($validator->validate($data)) {
  //Ok data is valid
} else {
  // Display validation errors
  print_r($validator->errors();
}
```

  #### Validate multiple sets of data :

```php
use Validator\Validator;

$validator = Validator::make([
  'name' => [
    'required' => true,
    'not_null' => true,
    'string' => true
  ],
  'gender' => [
    'required' => true,
    'not_null' => true,
    'string' => true,
    'lowercase' => true,
    'in' => ['male', 'female', 'other']
  ],
  'contact.email' => [
    'required' => true,
    'not_null' => true,
    'email' => true,
  ]
],
[
  'contact.email' => [
    'required' => 'Please enter email address.',
    'email' => 'Please enter valid email address.'
  ]
]);

// Data for validation
// We can validate any data like arrays, objects, and json etc.
$data = [
  [
    'name' => 'abc xyz',
    'gender' => 'male',
    'contact' => [
      'email' => 'xyz@gmail.com'
    ]
  ],
  [
    'name' => 'xyz abc',
    'gender' => 'male',
    'contact' => [
      'email' => 'xyz@gmail.com'
    ]
  ]
];

// Validate multiple sets of data
if($validator->validate($data, true)) {
  // Ok data is valid
} else {
  // Display validation errors
  print_r($validator->errors());
}
```

### Get Invalid Errors

  We can get errors using `errors` method. the `errors` method return an array of errors.

```php
// Get all errors
$errors = $validator->errors();
```

### Get Valid Data

  We can get valid parsed data using `getValidData` method. the `getValidData` method return an array of valid data.

```php
// Get all valid data
$errors = $validator->getValidData();
```

### Get Invalid Data

  We can get invalid parsed data using `getInvalidData` method. the `getInvalidData` method return an array of invalid data.

```php
// Get all invalid data
$errors = $validator->getInvalidData();
```


### Set validation rules

  Validator has a lots of predefined validation rules.

| Rules          | Value    | Description |
|----------------|----------|-------------|
| required       | boolean  | required fields check only data exists or not, it doesn't check data is empty or null. |
| null           | boolean  | check data is empty or null, use `true` for empty or null and use `false` for non empty or not null values. |
| not_null       | boolean  | check data is empty or null, use `true` for not null and use `false` for empty or null values. |
| alphabet       | boolean  | match alphabetical data. use `true` for alphabetical and `false` for non alphabetical values. |
| numeric        | boolean  | match numeric data. use `true` for numeric and `false` for non numeric values. |
| alphanumeric   | boolean  | match alphanumeric data. use `true` for alphanumeric and `false` for non alphanumeric values. |
| lowercase      | boolean  | match case of string. use `true` for lowercase and `false` for non lowercase values. |
| uppercase      | boolean  | match case of string. use `true` for uppercase and `false` for non uppercase values. |
| string         | boolean  | match string data type. use `true` for string and `false` for non string values. |
| integer        | boolean  | match integer data type. use `true` for integer and `false` for non integer values. |
| float          | boolean  | match float data type. use `true` for float and `false` for non float values. |
| boolean        | boolean  | match boolean data type. use `true` for boolean and `false` for non boolean values. |
| array          | boolean  | match array data type. use `true` for array and `false` for non array values. |
| object         | boolean  | match object data type. use `true` for object and `false` for non object values. |
| json           | boolean  | match json data type. use `true` for json and `false` for non json values. |
| minlength      | integer  | match minimum length of string. |
| maxlength      | integer  | match maximum length of string. |
| min            | integer  | match minimum value of number. |
| max            | integer  | match maximum value of number. |
| email          | boolean  | check given email is valid email address or not. |
| file           | boolean  | check data is uploaded file or not. |
| file_mime_type | array    | match file mime type in given array. |
| file_extension | array    | match file extension in given array. |
| min_file_size  | bytes    | match minimum file size. |
| max_file_size  | bytes    | match maximum file size. |
| in             | array    | match data in given array. |
| not_in         | array    | match data in given array. |
| equal          | mixed    | it will match data with given data. |
| not_equal      | mixed    | it will match data with given data. |

### Set Custom Rules

  We can set predefined/custom rules for data validation.
  Custom rules take a callback function with one argument. If custom rule return `true` that means data is valid and if it will return `false` that means data is invalid.

```php
// Set validation rules
$validator = Validator::make([
  'email' => [
    'required' => true,
    'not_null' => true,
    'email' => true,
    // Set your own custom rules
    'blocked' => function($value) {
      if($value == 'abc@gmail.com') {
        // Email abc@gmail.com is blocked
        return false;
      } else {
        return true;
      }
    },
    // Set your own custom rules
    'available' => is_available($value),
  ]
],
[
  // Set error messages for custom rules
  'email' => [
    'blocked' => 'this email address is blocked',
    'available' => 'this email address is already registered',
  ]
]);
```

## License

  [MIT License](https://github.com/unicframework/validator/blob/main/LICENSE)
