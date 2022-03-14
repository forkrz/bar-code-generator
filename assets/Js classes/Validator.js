export class Validator{
    checkIfInputEmpty = (type,value) =>{
        if(!type || !value){
            return true;
        }
    }

    doesCodeCanBeGeneratedOnlyWithNumChars = (type) =>{
        const types = ["EAN5","EAN8","EAN13","UPCE","IMB"];
        return types.includes(type)
    }

    doesStringContainsLetters = (value, type) =>{
        if(this.doesCodeCanBeGeneratedOnlyWithNumChars(type)){
            return /[a-zA-Z]/g.test(value);
        }
                
    }
}