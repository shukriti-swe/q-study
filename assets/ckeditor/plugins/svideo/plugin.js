CKEDITOR.plugins.add('svideo', {
    icons: 'svideo',
    allowedContent: 'div[data-responsive](!ckeditor-html5-video){text-align,float,margin-left,margin-right}; video[src,controls,autoplay,width, height]{max-width,height};',
    init: function (editor) {
        editor.addCommand('svideo', {
            exec: function (editor) {
                a = document.createElement('input');
                a.setAttribute('type', 'file');
                a.setAttribute('accept', '.mp4');
                a.click();
                a.onchange = function () {
                    file = a.files[0];
                    $(CKEDITOR.currentInstance).trigger('enableFormSubmit')
                    curr = CKEDITOR.currentInstance;
                    
//                    if (file.size > 500000000) {
//                        b = document.createElement('div')
//                        b.className = 'message alert alert-danger'
//                        m = document.createElement('span')
//                        m.innerHTML = "Video size exceeded! Please upload video of less than 5 MB."
//                        b.appendChild(m)
//                        c = document.createElement('span')
//                        c.className = 'close'
//                        c.innerHTML = 'X'
//                        b.appendChild(c)
//                        e = document.querySelector('.error-space');
//                        e.appendChild(b);
//                        setTimeout(function () {
//                            alert = document.querySelector('.alert-danger');
//                            alert.parentNode.removeChild(alert);
//                        }, 20000)
//                        c.onclick = function () {
//                            b = document.querySelector('.alert-danger');
//                            b.parentNode.removeChild(b);
//                        }
//                        $(CKEDITOR.instances[curr.name]).trigger('enableFormSubmit')
//                        return
//                    } 
                    if (['mp4', 'webm', 'ogg','avi', 'm4v'].indexOf(file.type.split('/')[1]) === -1) {
                        
                        b = document.createElement('div');
                        b.className = 'message alert alert-danger';
                        
                        m = document.createElement('span');
                        m.innerHTML = "The uploaded video format is not of acceptible format! Please upload an video!"
                        b.appendChild(m);
                        c = document.createElement('span');
                        c.className = 'close';
                        c.innerHTML = 'X';
                        b.appendChild(c);
                        e = document.querySelector('.error-space');
                        e.appendChild(b);
                        setTimeout(function () {
                            alert = document.querySelector('.alert-danger');
                            alert.parentNode.removeChild(alert);
                        }, 20000)
                        c.onclick = function () {
                            b = document.querySelector('.alert-danger');
                            b.parentNode.removeChild(b);
                        }
                        $(CKEDITOR.instances[curr.name]).trigger('enableFormSubmit')
                        return
                    }
                    img = new Image()
                    img.onload = function () {
                        inputWidth = this.width
                        inputHeight = this.height
                    }
                    img.src = window.URL.createObjectURL(file);
                    formData = new FormData;
                    formData.append('file', file);
                    loaderElem = new CKEDITOR.dom.element('loader-elem')
                    loaderHtmlStr = '<div style="position: relative; z-index: 100;width: 100%;height: 100%;text-align: center;background: white;opacity: 0.75;pointer-events:none">' + '<div style="width: 100%;height: 30px;margin-top: 100px;">Please wait while image is uploading...</div>' + '</div>'
                    loaderDomEle = CKEDITOR.dom.element.createFromHtml(loaderHtmlStr)
                    loaderElem.append(loaderDomEle)
                    editor.insertElement(loaderElem)
                    // CKEDITOR.currentInstance.setReadOnly(true)

                    $.ajax({
                        url: "imageUpload",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false
                    }).success((function (_this) {
                        return function (data, textStatus, jqXHR) {
                            console.log(data);
                            var isNew;
                            data = JSON.parse(data);
                            
                            if (jqXHR.status == 200) {
                                CKEDITOR.instances[curr.name].setReadOnly(false)
                                // url = editor.config.dataParser(data);
                                url = data.url;
                                var filename = url.replace(/^.*[\\\/]/, '');
                                elem = new CKEDITOR.dom.element('elem');
//                                maxWidth = Math.min(inputWidth, 600);
//                                maxHeight = Math.min(inputHeight, 600);
//                                if ((maxWidth / maxHeight) > (inputWidth / inputHeight)) {
//                                    width = (maxWidth * inputWidth) / inputHeight;
//                                    height = maxHeight;
//                                } else if ((maxWidth / maxHeight) < (inputWidth / inputHeight)) {
//                                    width = maxWidth;
//                                    height = (maxHeight * inputHeight) / inputWidth;
//                                } else {
//                                    width = maxWidth;
//                                    height = maxHeight
//                                }
                                newLine = CKEDITOR.dom.element.createFromHtml('<p><br></p>');
                                if (editor.config.srcSet) {
                                    srcSet = editor.config.srcSet(data)
//                                    imgElem = '<img src="' + url + '" class="image-editor" srcset="' + srcSet + '" data-width="' + inputWidth + '" data-height="' + inputHeight + '" height="' + height + '" width="' + width + '">'
                                    imgElem = url;
                                } else {
//                                    imgElem = '<img src="' + url + '" class="image-editor" data-width="' + inputWidth + '" data-height="' + inputHeight + '" height="' + height + '" width="' + width + '">'
                                    imgElem = url;
                                }
                                imgDomElem = CKEDITOR.dom.element.createFromHtml(imgElem)
                                elem.append(imgDomElem)
// //                                editor.insertElement(newLine)
//                                 editor.insertElement(elem)
// //                                editor.insertElement(newLine)
//                                 loaderElem.remove()
//                                 $(CKEDITOR.instances[curr.name]).trigger('enableFormSubmit')

                                 // editor.insertElement(newLine)
                                editor.insertElement(elem);
                                // editor.insertElement(newLine)
                                loaderElem.remove();
                                //$(CKEDITOR.instances[curr.name]).trigger('enableFormSubmit')
                                editor.setReadOnly(false)
                            }
                        }
                    }(this))).error((function (_this) {
                        return function (data, textStatus, jqXHR) {
                            CKEDITOR.instances[curr.name].setReadOnly(false)
                            b = document.createElement('div')
                            b.className = 'message alert alert-danger'
                            m = document.createElement('span')
                            m.innerHTML = "Video upload failed! Please try again!"
                            b.appendChild(m)
                            c = document.createElement('span')
                            c.className = 'close'
                            c.innerHTML = 'X'
                            b.appendChild(c)
                            e = document.querySelector('.error-space')
                            e.appendChild(b)
                            loaderElem.remove()
                            $(CKEDITOR.instances[curr.name]).trigger('enableFormSubmit')
                            setTimeout(function () {
                                alert = document.querySelector('.alert-danger')
                                alert.parentNode.removeChild(alert)
                            }, 20000)
                            c.onclick = function () {
                                b = document.querySelector('.alert-danger')
                                b.parentNode.removeChild(b)
                            }
                        }
                    }(this)))

                }

            }
        });

        editor.ui.addButton('SVideo', {
            label: 'Custom Video Uploader',
            command: 'svideo',
            toolbar: 'insert'
        });
    }
});
