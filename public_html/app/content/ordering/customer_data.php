
<!-- this url addres below is correct -->
<form id="make_order " name="make_order" action="http://greenbro.com/customer/choses_next_step" method="POST"
                     enctype="multipart/form-data">
<!-- making_order -->
<div id="user_ordering_form">
<h3>Оформлення замовлення </h3>
<br>

<h4>1. Ваші контактні дані </h4>
<!-- Personal contact information  -->
<br>
       <!-- Enter name -->
       <p>
       <label class="field_title" for="recipient_information">Ім'я</label>
       <input id="contact_recipient_name"  type="text" name="recipient_name" class="user_information" pattern="[А-Яа-яЁё\s][єЄ-іІ-їЇ]{2,25}"  placeholder="Введіть ім'я" title="Ім'я може складатися тільки з букв" required>
       </p>
       <!-- enter last name -->
       <p>
       <label class="field_title" for="recipient_information">Прізвище</label>
       <input id="contact_recipient_last_name"  type="text" name="recipient_last_name" class="user_information" pattern="[А-Яа-яЁё\s][єЄ-іІ-їЇ]{2,25}"  placeholder="Введіть ім'я по батькові" title="Прізвище може складатися тільки з букв" required>
       </p>
       <!-- enter email -->
       <p>
       <label class="field_title" for="recipient_information">Електронна адреса</label>
       <input id="contact_user_email"  type="text" name="user_email" class="user_information" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Введіть електронну адресу" title="Електронна адреса може містити літери англійського алфавіту, цифри та знак @" required>
       </p>
       <!-- enter mobile number -->
       <p>
        <label class="field_title" for="recipient_information">Мобільний телефон</label>
       <input id="contact_recipient_mobile_number"  type="text" name="recipient_mobile_number" class="user_information" pattern="([0]{1})([0-9]{9})" placeholder="Введіть мобільний телефон" title="Мобільний телефон може складатися тільки з цифр" required>
       </p>
        <input id="user_ordering_submit" type="submit" value="Продовжити оформлення" >
 </div>
 </form>


