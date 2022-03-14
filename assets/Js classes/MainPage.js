import {Api} from './Api.js'
import { DomElementGenerator } from './DomElementGenerator.js';
import {Validator} from './Validator.js'
export class MainPage{
    
    constructor(){
        this.api = new Api;
        this.Validator = new Validator;
        this.DomElementGenerator = new DomElementGenerator;
    }
    generateBtnAddEventListener = () =>{
        const btn = document.getElementById('btnBarcodeGenerator');

        btn.addEventListener('click',(e)=>{
            e.preventDefault();
            let type = document.getElementById('codeSelect').value;
            let value = document.getElementById('valueInput').value;
            
        });
    }

    listAddEventListeer = () =>{
        const type = document.getElementById('codeSelect');
        type.addEventListener('change', () =>{
            if(this.Validator.doesCodeCanBeGeneratedOnlyWithNumChars(type.value)){
                this.DomElementGenerator.createInfoElement('This barcode can be generated only with numbers');
            }
        });
    }
}