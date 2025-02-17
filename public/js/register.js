class Mask {
    constructor(inputElement, maskPattern) {
        this.inputElement = inputElement;
        this.maskPattern = maskPattern;
        this.init();
    }

    init() {
        this.inputElement.addEventListener('focus', () => this.setInitialValue());
        this.inputElement.addEventListener('input', (event) => this.applyMask(event));
        this.inputElement.addEventListener('blur', () => this.clearIfEmpty());
    }

    setInitialValue() {
        if (this.inputElement.value === '') {
            this.inputElement.value = '+7(___)-___-__-__';
        }
    }

    clearIfEmpty() {
        if (this.inputElement.value === '+7(___)-___-__-__') {
            this.inputElement.value = ''; 
        }
    }

    applyMask(event) {
        let value = event.target.value.replace(/[^0-9]/g, '');

    
        if (value.length > 11) {
            value = value.slice(0, 11);
        }


        let formattedValue = '+7';
        if (value.length > 1) {
            formattedValue += '(' + value.slice(1, 4); 
        }
        if (value.length >= 4) {
            formattedValue += ')-' + value.slice(4, 7); 
        }
        if (value.length >= 7) {
            formattedValue += '-' + value.slice(7, 9); 
        }
        if (value.length >= 9) {
            formattedValue += '-' + value.slice(9, 11); 
        }

      
        event.target.value = formattedValue;
    }
}


    const phoneInput = document.getElementById('phone__mask');
    const phoneMask = new Mask(phoneInput, '+7(999)-999-99-99');




