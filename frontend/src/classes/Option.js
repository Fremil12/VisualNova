export default class Option{
    #text;
    #next;
    #functions;
    constructor(text,next,functions) {
        this.setText(text);
        this.setNext(next);
        this.setFunctions(functions);

        this.setText = this.setText.bind(this);
        this.setNext = this.setNext.bind(this);
        this.setFunctions = this.setFunctions.bind(this);
        this.getText = this.getText.bind(this);
        this.getNext = this.getNext.bind(this);
        this.getFunctions = this.getFunctions.bind(this);
    }

    setText(param){
        this.#text = param;
    }
    setNext(param){
        this.#next = param;
    }
    setFunctions(param){
        this.#functions = param;
    }
    
    getText(){
        return this.#text;
    }
    getNext(){
        return this.#next;
    }
    getFunctions(){
        return this.#functions;
    }
};