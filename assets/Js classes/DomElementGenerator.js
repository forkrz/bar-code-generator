export class DomElementGenerator{
    
    createElement = (htmlTag,input,cssClass,parent) =>{
        const element = document.createElement(htmlTag);
        element.innerHTML = `${input}`;
        element.classList.add(cssClass);
        parent.appendChild(element);
    }

    removeElement = (element) =>{
        element.remove();
    }

    createInfoElement = (msg) =>{
        const container = this.createElement('div',"","d-flex,justify-content-center,reqInfo",document.getElementById('barcodeInputContainer'));
        container.id = "reqInfo";
        this.createElement('p',msg,"text-white",container);
    }

}