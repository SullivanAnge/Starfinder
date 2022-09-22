import Vue from 'vue';

console.log("ok");
new Vue (
    {
        el:'#perso',
        delimiters:['${','}$'],
        data:{
            message: 'hello world'
        }
    }
)