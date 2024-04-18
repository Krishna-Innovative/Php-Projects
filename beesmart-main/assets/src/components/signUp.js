import { Component } from '../core/component'
import { get } from '../utilities'

export class signUp extends Component {
    activeStep = 1;
    constructor(id) {
        super(id)

    }
    init() {
        // transmitDataHandler()
    }
}
// fransmit data for registeration
function transmitDataHandler() {
    transmitter.forEach((el, index) => {
        let input = get(el)
        // console.log(input, index)
        input?.addEventListener('change', () => {
            let recipientItem = get(recipient[index]) 
            recipientItem.value = input.value 
        })
        console.log(el)
    })

}
let transmitter = ['#Email', '#Password', '#user-confirm-password']
let recipient = ['input[data-key=user_email]', 'input[data-key=user_password]', 'input[data-key=confirm_user_password]']
