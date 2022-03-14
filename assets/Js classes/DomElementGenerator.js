export class DomElementGenerator{
    
    createElement = (htmlTag,input,cssClassesArr,childElement = null) =>{
        const element = document.createElement(htmlTag);
        element.innerHTML = `${input}`;
        element.classList.add(...cssClassesArr);
        childElement && element.appendChild(childElement)
        return element;
    }

    removeElement = (element) =>{
        element.remove();
    }

    addParagraph = (msg,textColor) =>{
        const paragraph = this.createElement('p',msg,[textColor],container);
        const cssClassesArrContainer = ['d-flex', 'justify-content-center', 'reqInfo']
        const container = this.createElement('div',"", cssClassesArrContainer ,paragraph);
        container.id = "reqInfo";
        document.getElementById('barcodeInputContainer').appendChild(container);
    }
    

}