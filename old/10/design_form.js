

function open_form(p, str_json, div_form){
    //p false design
    //p true form
    
    if (p) {

    }
    else
    {
        //design
        open_design_form(str_json, div_form);
    }
    console.log(p);
}


function open_design_form(str_json, div_form)
{
    var builder=document.
    var div_build=element("div");
    var btn1_build=element("button");
    var btn2_build=element("button");

    div_build.appendChild(btn1_build);
    div_build.appendChild(btn2_build);


}

function element(htmlTagName, styleName = null, validationStyleName = null) {
    let element = document.createElement(htmlTagName);
    if (styleName && this.style[styleName]) {
        if (this.style[styleName].classList)
            this.style[styleName].classList.forEach(x =>element.classList.add(x));
        if (this.style[styleName].style)
            for (const [key, value] of Object.entries(this.style[styleName].style))
                element.style[`${key}`] = value;
    }
    if (styleName) element.classList.add(`den${styleName}`);
    if (validationStyleName && this.style[validationStyleName]) {
        if (this.style[validationStyleName].classList)
            this.style[validationStyleName].classList.forEach(x =>element.classList.add(x));
        if (this.style[validationStyleName].style)
            for (const [key, value] of Object.entries(this.style[validationStyleName].style))
                element.style[`${key}`] = value;
    }
    if (validationStyleName) element.classList.add(`den${validationStyleName}`);
    return element;
}

var net_css = {
    Builder: { 
        classList: [],
        style: {},
    },
}