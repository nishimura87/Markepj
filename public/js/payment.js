const stripe = Stripe("pk_test_51MagfNDmfeAvy90GvoLdxxvfbhdFRocDX2drf2tKYpnUelsnEp86WDF61r7sspS0m6OAycFzEMZnnJWThWARd4v800c06wPDqc");
const elements = stripe.elements();
 
/* Stripe Elementsを使ったFormの各パーツをどんなデザインにしたいかを定義 */
const style = {
    base: {
        fontSize: '14px',
        color: "#32325d",
    }
};
 
const classes = {
    focus: 'is-focused',
    empty: 'is-empty',
    invalid: 'is-invalid'
};
 
/* フォームでdivタグになっている部分をStripe Elementsを使ってフォームに変換 */
const cardNumber = elements.create('cardNumber', {style:style,classes:classes});
cardNumber.mount('#cardNumber');
const cardCvc = elements.create('cardCvc', {style:style,classes:classes});
cardCvc.mount('#securityCode');
const cardExpiry = elements.create('cardExpiry', {style:style,classes:classes});
cardExpiry.mount('#expiration');

document.querySelector('#form_payment').addEventListener('submit', function(e) {

    e.preventDefault();

    stripe.createToken(cardNumber,{name: document.querySelector('#cardName').value}).then(function(result) {

        /* errorが返ってきた場合はその旨を表示 */
        if (result.error) {
            alert("カード登録処理時にエラーが発生しました。カード番号が正しいものかどうかをご確認いただくか、別のクレジットカードで登録してみてください。");
        } else {
            stripeTokenHandler(result.token);
        }
    });

    function stripeTokenHandler(token) {
        const form = document.getElementById('form_payment');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }

},false);