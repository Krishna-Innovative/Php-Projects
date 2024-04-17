import { Component } from '../core/component'
import { get } from '../utilities'

export class feed extends Component {
    constructor(id) {
        super(id)
    }
    init() {
        addHiveHandler()
    }
}
// sample for guide page 
function addHiveHandler() {
    if (get('.ajax-load-more-wrap')) {
        let feedList = get('.ajax-load-more-wrap')
        feedList.addEventListener('click', (e) => {
            if (e.target.closest('a.dropdown-item')) {
                let thisOption = e.target.closest('a.dropdown-item'),
                    // option property
                    img = thisOption.querySelector('img'), // image of option
                    text = thisOption.querySelector('span').textContent,

                    // property where needs append option property
                    placeholder = thisOption.closest('div').previousElementSibling, // button 
                    placeholderIcon = placeholder.querySelector('img')    // icon

                // appending values
                placeholder.querySelector('span').textContent = text
                placeholderIcon.src = img.src

            }
        })
    }
}

function getImagePreview() {
    $(document).ready(function () {
        console.log('start')

        function massPreview() {

            var sendRequestEachValue = function (values, containers) {
                var newMetas = values,
                    meta = newMetas[0]
                newMetas.splice(0, 1)

                var newContainers = containers,
                    container = newContainers[0]
                newContainers.splice(0, 1)
                $.ajax({
                    type: 'post',
                    url: '/wp-admin/admin-ajax.php',
                    data: {
                        action: 'get_image_preview_for_single_post',
                        link: meta
                    },
                    cache: false,
                    success: function (response) {
                        $('#loading').text('');
                        $(container).show();
                        $(container).html(response);
                    }
                });
            }
            var metas = document.querySelectorAll('.meta-preview');
            var containerResposnes = document.querySelectorAll('.container-resposne');


            var metasArray = []
            var containerResponsesArray = []

            containerResposnes.forEach(container => {
                containerResponsesArray.push(container)
            })

            metas.forEach(meta => {
                metasArray.push(meta.value)
            })

            /*console.log(metasArray)
            console.log(containerResponsesArray)*/

            metas.forEach(m => {
                console.log('handle')
                sendRequestEachValue(metasArray, containerResponsesArray)
            })
        }
        setTimeout(massPreview, 10000)
    });
}
