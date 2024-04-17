export class Progres {
    static progresHandle(step, selector){
        return document.querySelector(selector).style.width =+ step + '%'
    }
}