import { Component } from '../../core/component'
import { Form } from '../../core/form'
import { Validators } from '../../core/validators'
import { get, agreementHandler, getPostPreview, getAll, siteURL, imgPATH } from '../../utilities'
export class CreatePostStep3 extends Component {
    constructor(id) {
        super(id)
    }
    init() {
        // step 2
        if (get('.step-2-section')) {
            getPostPreview('#f_url', '.container-resposne')
        }
        // step 3 
        if (get('#accept-terms')) {
            let agreeButton = get('#accept-terms'),
                agreeLabel = get('label[for=accept-terms]'),
                createPostButton = get('button[data-id=step-3-next]')

            agreeLabel.addEventListener('click', () => {
                agreeLabelHandle(agreeLabel)
            })

            agreementHandler(agreeButton, createPostButton)

            // explicitHandler()
        }
        /**
         * step 3 validation before post created
         */
        if (get('.step_3_area')) {
            get('button.step-btn.step-submit__button')?.addEventListener('click', submitHandler.bind(this))
            // let tagsList = getAll('.select2-selection__choice')
            this.form = new Form(this.$el, {
                // f_url: [Validators.url, Validators.minLength(10), Validators.isUrl],
                // title: [Validators.title],
                // fulltext: [Validators.required, Validators.description(10)]
                // tagsList: [],
                'acf[field_6242b43938a94]': [Validators.required, Validators.description(10)]
            })
            console.log(this.form)
            console.log(this.$el)
        }
    }
}
function submitHandler(event) {
    event.preventDefault()
    if (this.form.isValid()) {
        const formData = {
            ...this.form.value()
        }
        progresHandle(100, '.progress-bar.active')
        // nextStepNumber3('.post-form-fields', '.additiona-form-fields', 'grid')
        // this.form.clear()
        console.log('step-3-form', formData)
    }
}

function agreeLabelHandle(btn) {
    if (btn.classList.contains('agreed')) {
        btn.classList.remove('agreed')
    } else {
        btn.classList.add('agreed')
    }
}

window.addEventListener('load', () => {
    function appendBlock(a, b) {
        try {
            let get = document.querySelector(a)
            let putHere = document.querySelector(b)
            putHere.append(get)

        } catch (e) {
            console.log(e)
        }
    }
    // tags
    appendBlock(
        '.acf-field.acf-field-taxonomy.acf-field-6242b34b38a92',
        '.tag_area'
    )
    // additional text
    appendBlock(
        '.acf-field.acf-field-textarea.acf-field-6242b43938a94',
        '.additional_area'
    )

})
