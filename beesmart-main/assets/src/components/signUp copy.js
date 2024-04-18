import { Component } from '../core/component'
import { get } from '../utilities'

export class signUp extends Component {
    activeStep = 1;
    constructor(id, selector) {
        super(id)
        this.page = get(selector)
        this.tabs = this.page.querySelector('ul#myTab')
        this.myTabContent = this.page.querySelector('ul#myTabContent')
        this.step = get(`#step-${this.activeStep}`)
        this.stepHandler()
    }
    init() {
        this.page.addEventListener('click', (e) => this.target(e))
    }

    target(e) {
        console.log(e.target);
        if (e.target.dataset.step) {
            let stepForm = get(`.${e.target.dataset.step}`)
            // console.log(stepForm);
            this.nick = stepForm.querySelector('#user-nickname')
            this.agreeBtn = stepForm.querySelector('#agree-button')
            this.agreeBtn.addEventListener('click', function () {
                this.setValid()
            })
            if (this.nick.value.length > 3) {
                this.nick.fieldValid = true
            } 
            else { 
                alert('input')
            }
            if (this.agreeBtn.fieldValid != true) {
                alert('btn')
            } 
            else {
                console.log('true')
            }
        }
    }
    setValid() {
        console.log(this)
        this.fieldValid = true
        console.dir(stepForm.querySelector('#agree-button'))
    }
    stepHandler() {
        this.step = get(`#step-${step}`)
        this.agreeBtn = this.step.querySelector('#agree-button')
        this.agreeBtn.addEventListener('click', ()=> this.setValid())
    }
} 