import {Api} from './Api.js'

export class MainPage{
    
    constructor(){
        this.api = new Api;
    }
    generateBtnAddEventListener = () =>{
        const btn = document.getElementById('btnBarcodeGenerator');

        btn.addEventListener('click',(e)=>{
            e.preventDefault();
            let type = document.getElementById('codeSelect').value;
            let value = document.getElementById('valueInput').value;
            this.api.getBarcode(type,value);
            
        })
    }
}