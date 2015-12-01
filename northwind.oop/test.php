<?php
use Forms\Form as Form;
use Forms\Form2 as Form2;
use Forms\Form3 as Form3;
use Forms\Utility as Utility;
use Forms\User as User;
use Forms\InputText as InputText;
use Forms\StringLengthValidator as StringLengthValidator;

//youtube video to composer installation and usage
//https://www.youtube.com/watch?v=317AtqzbKho
//require_once __DIR__ . "/vendor/autoload.php";
require_once('vendor/autoload.php');

//Instanciate a form object
$form = new Forms\Form();
var_dump($form);

echo PHP_EOL . '<br />';

//Instanciates another form object
$anotherForm = new Forms\Form();
var_dump($anotherForm);

echo PHP_EOL . '<br />';

//Verify data type
echo gettype($form);

$form = new forms\Form();
$anotherForm = clone $form;

//Testing in this manner identifies unique objects
if($anotherForm === $form){
    echo 'They are aliases';
}
else{
    echo 'They are duplicates';
}

echo PHP_EOL . '<br />';

/*Assigning creates an alias to the original object.  This allows
 * two variables to write to the same values.  In this case, $anotherForm
 * only contains an object identifier which allows access to the same object
 * */
$anotherForm = $form;

echo PHP_EOL . '<br />';

//Testing in this manner identifies the alias and, therefore, the same object
if($anotherForm == $form){
    echo 'They are aliases<br />';
}
else{
    echo 'They are duplicates<br />';
}

echo PHP_EOL . '<br />';

//create new object
$form = new Form();

//Destroy using unset()
unset($form);
var_dump($form);

$from = new Form();
$from = null;
var_dump($form);

$form = new Form();
$form->setName("Login");
$name = $form->getName();

echo $name;

echo PHP_EOL . '<br />';

//createing an new property
$form = new Form();
$form->set("id", "itemId");

echo $form->id . '<br />';

unset($form->name);
$form->set('name');

$attributes = ['nameAttribute'=>'Registration', 
                'classAttribute' => 'FormClass1'];

$id = 'FormId';

$form = new Form();
$form->setFormAttribs($attributes);
$form->setId($id);

echo $form->classAttribute . '<br />';
echo $form->nameAttribute . '<br />';
echo $form->id . '<br />';

$logger = new Forms\Logger();
//Log some data
$data = "Some Data to Log";
$logger->logger($data);

//Echo the page content
echo $logger->loadHTML();

echo PHP_EOL."<br />";

$form = new Form();

echo PHP_EOL."<br />";

$loginForm = new Form("Login", "Form1");
$registerForm = new Form("Register", "Form2");

echo $loginForm->getName().PHP_EOL."<br/>";
echo $registerForm->getName().PHP_EOL."<br/>";

$type = 'text';
$name = 'username';
$fields[] = new Forms\Field($type, $name);

$name = 'password';
$fields[] = new Forms\Field($type, $name);

$name = 'Login';
$id = 'Form1';
$form = new Forms\Form2($name, $id, $fields);

//output
echo $form->getStartTag().PHP_EOL."<br />";
foreach($form->getFields() as $field){
    echo ucfirst($field->getName()).': '.$field->getTag().PHP_EOL."<br />";
}
echo $form->getEndTag();

$total = 125;
echo Utility::formatCurrency($total);

echo PHP_EOL."<br/>";

$firstname = "Ian";
$lastname = "Morrison";
$email = "ian@abc.com";
$assetValue = 1000;
$user1 = new User($firstname, $lastname, $email, $assetValue);

$firstname = "Jane";
$lastname = "Morrison";
$email = "jane@abc.com";
$assetValue = 2000;
$user2 = new User($firstname, $lastname, $email, $assetValue);

echo 'Ian\'s asset value = ' . Utility::formatCurrency($user1->assetValue) . '<br />';
echo 'Jane\'s asset value = ' . Utility::formatCurrency($user2->assetValue) . '<br />';

echo PHP_EOL."<br/>";
echo PHP_EOL."<br/>";

$name = "Login";
$id = "Form3"; 
$usernameInput = new InputText();
$usernameInput->setLabel('username');
$usernameInput->setRequired();

$passwordInput = new InputText();
$passwordInput->setLabel('password');
$passwordInput->setRequired();
$passwordInput->setType("password");

$submitInput = new InputText();
$submitInput->setType("submit");

$fields = [
    'username' => $usernameInput,
    'password' => $passwordInput, 
    'submit' => $submitInput
    ];

$form = new Form3($name, $id, $fields);

//if the form was submitted
if(!empty($_POST['Username']) && !empty($_POST['Password']) ){
    $username = ctype_alnum($_POST['Username']) ? $_POST['Username'] : null;
    $password = ctype_alnum($_POST['Password']) ? $_POST['Password'] : null;
    StringLengthValidator::setMaximim(39);
    StringLengthValidator::setMinimum(5);
    if(StringLengthValidator::validate($password) && StringLengthValidator::validate($username)){
        echo "<h1>Thank you for logging in $username </h1>";
    }
    else{
        echo "invalid input, username and password must be between 5 and 38 characters.<br />";
        $username = "";
        $password = "";
    }
}
else{
    echo '<h1>Hello. Please Login</h1>';
    echo $form->getStartTag() . '<br/>';
    foreach($form->getFields() as $field){
        if($field->label) 
            echo $field->label . ": ";

        echo $field->getInput() . "<br />";
    }
    echo $form->getEndTag();
}

echo PHP_EOL."<br/>";
echo PHP_EOL."<br/>";
?>