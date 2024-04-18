export class Component {
  constructor(id) {
    window.addEventListener('load', ()=>{
      this.$el = document.getElementById(id)
      this.init()
    })
  }

  init() {}

  hide() {
    this.$el.classList.add('hide')
  }

  show() {
    this.$el.classList.remove('hide')
  }
}