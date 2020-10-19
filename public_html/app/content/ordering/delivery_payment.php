<!-- this url addres below is correct -->
<form id= "make_order " name="make_order" action="http://greenbro.com/order/gather_order_data" method="POST"
                     enctype="multipart/form-data">
<!-- making_order -->
<div id="user_ordering_form">

<h4>3. Доставка</h4>
<!-- Method of delivery  -->
<br>
<p><input type="radio" id="radioButton" name="delivery_type" value="post_office" checked>&nbsp;&nbsp;Самовивіз з Нової Пошти</p>
<!-- address for delivery-->
       <p>
       <label class="field_title" for="recipient_information">Адреса доставки</label>
       <input id="delivery_address"  type="text" name="delivery_address" class="user_information" pattern="[А-Яа-яЁё\s,єЄ-іІ-їЇ,0-9,№,.,]{15,105}" title="Адреса доставки може містити тільки букви, цифри і символ №"  placeholder="Введіть місто, адресу та номер відділення" required>
       </p>

<p><input type="radio" id="radioButton" name="delivery_type" value="courier">&nbsp;&nbsp;Доставка кур'єром Нової Пошти</p>


<h4>4. Оплата</h4>
<!-- Way of payment  -->
<br>
<p><input type="radio" id="radioButton" name="payment_type" value="cash" checked>&nbsp;&nbsp;Оплата при отриманні товару</p>
<p><input type="radio" id="radioButton" name="payment_type" value="without_cash">&nbsp;&nbsp;Карткою чи за допомогою онлайн банкінгу</p>
      
        <input id="user_ordering_submit" type="submit" value="Замовлення підтверджую">
 </div>
 </form>




