export class MainPage{
    
    generateBtnAddEventListener = () =>{
        const btn = document.getElementById('btnBarcodeGenerator');

        btn.addEventListener('click',(e)=>{
            e.preventDefault();
            let type = document.getElementById('codeSelect').value;
            let value = document.getElementById('valueInput').value;
            
        })
    }
}