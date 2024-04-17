export class Validators {

  static required(value = '') {
    if (value && value.trim()){
      return value && value.trim()
    } 
    // else {
    //   toastr["warning"]('not correct');
    // }
  }

  static title(value = '') {
    if (value && value.trim()){
      return value && value.trim()
    } else {
      toastr["warning"]('Title is required');
    }
  }

  static url(value = '') {
    if (value && value.trim()){
      return value && value.trim()
    } else {
      toastr["warning"]('Insert link please');
    }
  }

 static isUrl(value = '') {
    if (value.match('http')){
      return value 
    } else {
      toastr["warning"]('Link is not correct');
    }
  }

  static description(length) {
    return value => {
      if (value.length >= length) {
        return value.length >= length
      } else {
        toastr["warning"]('The description must be at least 10 characters long');
      }
    }
  }

  static minLength(length) {
    return value => {
      return value.length >= length
    }
  }

}
