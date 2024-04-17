import {agreementHandler} from '../utilities'

function mapUsingAgreemant(){
	if(document.querySelector('div#map-popup')){
		let mapPopup = document.querySelector('div#map-popup'),
			agreeCheckbox = mapPopup.querySelector('input#geo-agreement'),
			finisBtn = mapPopup.querySelector('#closeMap')
		agreementHandler(agreeCheckbox, finisBtn)
	}
}

window.addEventListener('load', ()=>{
	mapUsingAgreemant()

})
