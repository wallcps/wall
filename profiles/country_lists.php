<?php 
$countries = array(
   '0' => '-- Please Select --',
   'cambodia' => 'Cambodia',
   'New Zealand' => 'New Zealand',
   'Afghanistan' => 'Afghanistan',
   'Albania' =>'Albania',
   'Algeria' =>'Algeria',
   'American Samoa' =>'American  Samoa',
   'Andorra' =>'Andorra',
   'Angola' =>'Angola',
   'Austria' =>'Austria',
   'Azerbaijan' =>'Azerbaijan',
   'Belarus' =>'Belarus',
   'Belgium' =>'Belgium',
   'Belize' =>'Belize',
   'Benin' =>'Benin',
   'Bermuda' =>'Bermuda',
   'Bhutan' =>'Bhutan',
   'Botswana' =>'Botswana',
   'Brazil' =>'Brazil',
   'Burkina Faso' =>'Burkina Faso',
   'Cambodia' =>'Cambodia',
   'Cameroon' =>'Cameroon',
   'Canada' =>'Canada',
   'Cape Verde' =>'Cape Verde',
   'Cayman Islands' =>'Cayman Islands',
   'Central African Republic' =>'Central African Republic',
   'Chad' =>'Chad',
   'Chile' =>'Chile',
   'China' =>'China',
   'Colombia' =>'Colombia',
   'Comoros' =>'Comoros',
   'Congo' =>'Congo',
   'Cook Islands' =>'Cook Islands',
   'Costa Rica' =>'Costa Rica',
   'Croatia' =>'Croatia',
   'Cuba' =>'Cuba',
   'Curacao' =>'Curacao',
   'Cyprus' =>'Cyprus',
   'Czech Republic' =>'Czech Republic',
   'Democratic Republic of Congo' =>'Democratic Republic of Congo',
   'Denmark' =>'Denmark',
   'Diego Garcia' =>'Diego Garcia',
   'Djibouti' =>'Djibouti',
   'Dominica' =>'Dominica',
   'England' =>'England',
   'Equatorial Guinea' =>'Equatorial Guinea',
   'Eritrea' =>'Eritrea',
   'Estonia' =>'Estonia',
   'Ethiopia' =>'Ethiopia',
   'Falkland (Malvinas) Islands' =>'Falkland (Malvinas) Islands',
   'Faroe Islands' =>'Faroe Islands',
   'Fiji' =>'Fiji',
   'Finland' =>'Finland',
   'France' =>'France',
   'French Polynesia' =>'French Polynesia',
   'Gabon' =>'Gabon',
   'Gambia' =>'Gambia',
   'Georgia' =>'Georgia',
   'Germany' =>'Germany',
   'Ghana' =>'Ghana',
   'Greece' =>'Greece',
   'Greenland' =>'Greenland',
   'Guadeloupe' =>'Guadeloupe',
   'Guatemala' =>'Guatemala',
   'Guinea' =>'Guinea',
   'North Korea' =>'North Korea',
   'India' =>'India',
   'Indonesia' =>'Indonesia',
   'Iran' =>'Iran',
   'Italy' =>'Italy',
   'Israel' =>'Israel',
   'Japan' =>'Japan',
   'Laos' =>'Laos',
   'Malaysia' =>'Malaysia',
   'Nepal' =>'Nepal',
   'Thailand' =>'Thailand',
   'United Kingdom' =>'United Kingdom',
   'Vietnam' =>'Vietnam',
   'Swaziland' =>'Swaziland'
);

?>
<select name="country" id="countrys" class="form-control">
   <?php foreach($countries as $key => $value) {
       if ($key == $country) {
           echo "<option value='".$key."' selected>".$value."</option>";
       } else {
           echo "<option value='".$key."'>".$value."</option>";
       }
   }
    ?>
</select>