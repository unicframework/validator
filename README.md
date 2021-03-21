## Validator

<p align="center">
  <img src="logo.jpg" width="400px" alt="Validator Logo">
</p>

  Validator is a server side data validation library for PHP. Validate html form-data, objects, arrays and json etc.

### Installation

  - Install `composer` if you have not installed.

```shell
composer require unicframework/validator
```

### Set Validation Rules

  We can set data validation rules using `rules` method.

```php
$validator->rules([
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
$validator->rules([
  'first_name,last_name' => 'required|not_null|string',
  'email' => 'required|not_null|email',
  'gender' => 'required|not_null|in:male,female',
  'password' => 'required|not_null|minlength:6'
]);
```

### Set Error Messages

  We can set error messages using `messages` method. if we don't set error messages then validator automatically generate error messages for you.

```php
$validator->messages([
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
$validator->rules([
  'first_name,last_name' => 'required:Name is required|not_null:Name can not be null|string:Name should be in string',
  'email' => 'required:Email is required|not_null:Email can not be null|email:Please enter valid email address',
  'gender' => 'required:Gender is required|not_null:Gender can not be null|in:Please select valid gender'
  'password' => 'required: Password is required|not_null:Password can not be null|minlength:Password length should be minimum 5 characters',
]);
```

### Validate Data
  Using validator we can validate form-data, array, object and json data. we validate data using `validate` method. if all data is valid then it will return `true` otherwise it will return `false`.

```php
//Array data
$data = [
  'name' => 'abc',
  'email' => 'abc@gmail.com'
];

//Check data is valid or not
if($validator->validate($data)) {
  //Data is valid
} else {
  //Display all errors
  print_r($validator->errors());
}
```

  We can validate multiple sets of data using validator.

```php
//Array data
$data = [
  [
    'name' => 'abc',
    'email' => 'abc@gmail.com'
  ],
  [
    'name' => 'abc',
    'email' => 'abc@gmail.com'
  ]
];

//Check data is valid or not
if($validator->validate($data, true)) {
  //Data is valid
} else {
  //Display all errors
  print_r($validator->errors());
}
```

### Get Invalid Errors

  We can get errors using `errors` method. the `errors` method return an array of errors.

```php
//Get all errors
$errors = validator->errors();
```

### Validate HTML Form-Data

```php
use Validator\Validator;

$validator = new Validator();

//Set validation rules
$validator->rules([
  'name' => [
    'required' => true,
    'not_null' => true,
    'string' => true
  ],
  'email' => [
    'required' => true,
    'not_null' => true,
    'email' => true
  ],
  'password' => [
    'required' => true,
    'not_null' => true,
    'minlength' => 6,
    'maxlength' => 15
  ]
]);

//Validate form data
if($validator->validate($_POST)) {
  //Ok data is valid
} else {
  //Display validation errors
  print_r($validator->errors());
}
```

### Validate Custom Data

  We can validate custom data like objects, json, arrays etc.

  #### Validate single data :

```php
use Validator\Validator;

$validator = new Validator();

//Data for validation
//We can validate any data like arrays, objects, and json etc.
$data = [
  'name' => 'abc xyz',
  'gender' => 'male',
  'email' => 'abc@gmail.com'
];

//Set validation rules
$validator->rules([
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
  'email' => [
    'required' => true,
    'not_null' => true,
    'email' => true
  ]
]);

//Validate custom data
if($validator->validate($data)) {
  //Ok data is valid
} else {
  //Display validation errors
  print_r($validator->errors();
}
```

  #### Validate multiple sets of data :

```php
use Validator\Validator;

$validator = new Validator();

//Data for validation
//We can validate any data like arrays, objects, and json etc.
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

//Set validation rules
$validator->rules([
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
]);

//Set validation messages
$validator->messages([
  'contact.email' => [
    'required' => 'Please enter email address.',
    'email' => 'Please enter valid email address.'
  ]
]);

//Validate multiple sets of data
if($validator->validate($data, true)) {
  //Ok data is valid
} else {
  //Display validation errors
  print_r($validator->errors());
}
```


### Set validation rules

  Validator has a lots of predefined validation rules.

| Rules          | Value    | Description |
|----------------|----------|-------------|
| required       | boolean  | required fields check only data exists or not, it doesn't check data is empty or null. |
| null           | boolean  | check data is empty or null, use `true` for empty or null and use `false` for non empty or not null values. |
| not_null           | boolean  | check data is empty or null, use `true` for not null and use `false` for empty or null values. |
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
| callback       | function | callback function is called during validation of field. we can pass single callback function and array of callback function. callback function take one parameter `value`. |
| rules          | array    | set custom validation rules. custom rules are set of key value pairs, if any key has false value then it will throw an error. we can pass callback function in custom validation rules. function accept one parameter `value` and return true or false values. |

### Set Custom Rules

  We can set predefined/custom rules for data validation.

```php
//Set validation rules
$validator->rules([
  'name' => [
    'required' => true,
    'not_null' => true,
    'string' => true
  ],
  'gender' => [
    'required' => true,
    'not_null' => true,
    'string' => true,
    'in' => ['male', 'female', 'other']
  ],
  'email' => [
    'required' => true,
    'not_null' => true,
    'email' => true,
    'rules' => [
      //Set your own custom rules
      'blocked' => function($value) {
        if($value == 'abc@gmail.com') {
          //email abc@gmail.com is blocked
          return false;
        } else {
          return true;
        }
      },
      'available' => is_available($value)
    ]
  ],
  'password' => [
    'required' => true,
    'not_null' => true,
    'minlength' => 6,
    'maxlength' => 15
  ],
  'profile_image' => [
    'file' => true,
    'max_file_size' => 2000000,
    'file_extension' => ['jpg', 'png']
  ]
]);
```

## License

  [MIT License](https://github.com/unicframework/validator/blob/main/LICENSE)
