const toggle = document.querySelector('#toggle');
const input = document.querySelector('#input');
toggle.addEventListener('click',()=>{
   if(toggle.type === 'password'){
       toggle.type= 'text';
   }else{
       toggle,type = 'password';
   }

})

