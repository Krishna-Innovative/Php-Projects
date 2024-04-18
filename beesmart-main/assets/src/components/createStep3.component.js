import { Component } from '../core/component'
import { Form } from '../core/form'
import { Validators } from '../core/validators'
// import { Progres } from '../core/progres'

export class CreateStep3Component extends Component {
  constructor(id) {
    super(id)
  }

  init() {

    // window.addEventListener('load', function(){
      // $(document).ready(function(){
      let submitBtn = document.querySelector('#step-submit__button')
      // additionalText = 'acf[field_6242b43938a94]'
      // submitBtn.addEventListener('click', submitHandler.bind(this))
      this.form = new Form(this.$el, {
        // input#acf-field_6242b34b38a92-input 
        // li.select2-selection__choice
        // tags = this.$el.querySelector('li.select2-selection__choice'),
        // tags: [],

        // location
        // acf[field_624a4e9f377db]:[Validators.required],

        // select#acf-field_6242b3d438a93
        // language = document.querySelector('select#acf-field_6242b3d438a93'),
        // language: [Validators.required, Validators.minLength(10)],

        // additional text
        // 'acf[field_6242b43938a94]' : [Validators.required, Validators.minLength(10)]
      })
      
      console.log(submitBtn)
    // })
  }

}

function progresHandle(step, selector){
  return document.querySelector(selector).style.width =+ step + '%'
}
  // function nextStepTest(currentStep, nextStep, type){
  //   hide(currentStep)
  //   show(nextStep, type)
  // }
  // function nextStepNumber3(currentStep, nextStep, type){
  //   hide(document.querySelector(currentStep))
  //   show(document.querySelector(nextStep), type)
  // }
  // function hide(el){
  //   el.style.display = 'none'
  // }
  // function show(el, type){
  //   el.style.display = type
  // }
function submitHandler(event) {
  event.preventDefault()
  progresHandle(100, '.progress-bar.active')
  if (this.form.isValid()) {
  //   progresHandle(100, '.progress-bar.active')
  //   nextStepNumber3('.post-form-fields', '.additiona-form-fields', 'grid')
    const formData = {
      ...this.form.value()
    }

    this.form.clear()
  
    console.log('Submit', formData)
  } else {
    $(document).ready(function onDocumentReady() {
      toastr.success('Fill in the fields correctly.');
    });
  }
}