import 'jquery';

const element = document.getElementById('phone');
const mail = document.getElementById('email');
const maskOptions = {
  mask: '(000)000-0000'
};
const mask = IMask(element, maskOptions);


const emailMask = IMask(mail, {
    mask: /^\S*@?\S*$/
  });