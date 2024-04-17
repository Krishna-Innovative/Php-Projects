import { Component } from '../../core/component'
import { Form } from '../../core/form'
import { Validators } from '../../core/validators'
import { get } from '../../utilities'
// import { Progres } from '../core/progres'
export class premiumComponent extends Component {
    constructor(id) {
        super(id)
    }

    init() {

        // window.addEventListener('load', function(){
        // $(document).ready(function(){
        document.querySelector('button[data-id=step-premium-next]')?.addEventListener('click', submitHandler.bind(this))
        this.sell = {
            block: get('#premium-step-form'),
        }
        // this.form = new Form(this.$el, {
        //     // f_url: [Validators.url, Validators.minLength(10), Validators.isUrl],
        //     // title: [Validators.title],
        //     // fulltext: [Validators.required, Validators.description(10)]
        // })

        console.log(this.sell)
        // })
    }

}

function progresHandle(step, selector) {
    return document.querySelector(selector).style.width = + step + '%'
}
function nextStepTest(currentStep, nextStep, type) {
    hide(currentStep)
    show(nextStep, type)
}
function nextStepNumber3(currentStep, nextStep, type) {
    hide(document.querySelector(currentStep))
    show(document.querySelector(nextStep), type)
}
function hide(el) {
    el.style.display = 'none'
}
function show(el, type) {
    el.style.display = type
}
function submitHandler(event) {
    event.preventDefault()
    if (this.form.isValid()) {
        const formData = {
            ...this.form.value()
        }
        progresHandle(76, '.progress-bar.active')
        nextStepNumber3('.post-form-fields', '.additiona-form-fields', 'grid')
        // this.form.clear()
        console.log('step-2', formData)
    }
}
