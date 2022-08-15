let design_area = $("#design-area");
let responsive_container = $("#design-responsive");
let rotation_input = $('#rotation');
let bold_button = $('#bold');
let italic_button = $('#italic');
let color_button = $('#color');
let color_icon = $('#color-icon');
let textLeft_button = $('#textLeft');
let textCenter_button = $('#textCenter');
let textRight_button = $('#textRight');
let lock_button = $('#lock');
let group_button = $('#group');
let flip_button = $('#flip');
let fontType_Select = $('#font-type');

//Responsive page design area
let scale = 1

const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
})


canvas.on('selection:cleared', function (options) {
    resetAllInputs();
});

canvas.on('mouse:down', function (options) {
    fontType_Select.addClass('d-none')
    if (options.target) {
        console.log('Object Type : ' + options.target.get('type'))
        if (options.target.get('type') === 'i-text') {
            fontType_Select.removeClass('d-none')
        }
        checkChangesOnSelect(options.target)
    }
});


function checkChangesOnSelect(element) {
    rotation_input.val((element.angle).toFixed(0));
    color_icon.css('color', element.getFill());
    fontType_Select.val(element.get('fontFamily'));

    if (element.get("fontWeight") === "bold") {
        bold_button.addClass('active')
    }else{
        bold_button.removeClass('active')
    }

    if (element.get("fontStyle") === "italic") {
        italic_button.addClass('active')
    }else{
        italic_button.removeClass('active')
    }

    if (element.get('textAlign') === "left") {
        textLeft_button.addClass('active')
    }else{
        textLeft_button.removeClass('active')
    }
    if (element.get('textAlign') === "center") {
        textCenter_button.addClass('active')
    }else{
        textCenter_button.removeClass('active')
    }
    if (element.get('textAlign') === "right") {
        textRight_button.addClass('active')
    }else{
        textRight_button.removeClass('active')
    }
    if (element.get('lockMovementY') === true) {
        lock_button.addClass('active')
    }else{
        lock_button.removeClass('active')
    }

    if (element.type === 'group') {
        group_button.addClass('active')
    }else{
        group_button.removeClass('active')
    }

}

function resetAllInputs() {
    bold_button.removeClass('active');
    italic_button.removeClass('active');
    color_button.removeClass('active');
    textLeft_button.removeClass('active');
    textCenter_button.removeClass('active');
    textRight_button.removeClass('active');
    flip_button.removeClass('active');
    lock_button.removeClass('active')
    group_button.removeClass('active')
    color_icon.css('color', 'black');
    fontType_Select.val("none");
    rotation_input.val("0");

}


function newText() {
    canvas.add(new fabric.IText('Tap and Type', {
        left: 50,
        top: 100,
        fontFamily: 'arial, serif',
        fill: '#333',
        fontSize: 50
    }));
}

newText();


function newIcon(icon) {
    let Src = icon.src;
    if (Src.indexOf('.svg') === -1) {
        fabric.Image.fromURL(Src, function (myImg) {
            let img = myImg.set({left: 0, top: 0});
            canvas.add(img);
        }, {crossOrigin: 'anonymous'});
    } else {
        fabric.loadSVGFromURL(Src, function (objects, options) {
            let svg = fabric.util.groupSVGElements(objects, options);
            canvas.add(svg);
        }, {crossOrigin: 'anonymous'});
    }

}

function changeBackground() {
    console.log(JSON.stringify(canvas))
}


function deleteElement() {
    if (canvas.getActiveObject()) {
        canvas.getActiveObjects().forEach((obj) => {
            canvas.remove(obj)
        });
        canvas.discardActiveObject().renderAll()
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}

function cloneElement() {

    if (canvas.getActiveObject()) {
        let object = fabric.util.object.clone(canvas.getActiveObject());
        object.set("top", object.top + 10);
        object.set("left", object.left + 10);
        canvas.add(object);
        canvas.setActiveObject(object);
        checkChangesOnSelect(object);
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}

function flip() {
    if (canvas.getActiveObject()) {
        canvas.getActiveObject().set('flipX', !canvas.getActiveObject().flipX);
        canvas.renderAll();
        checkChangesOnSelect(canvas.getActiveObject());
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}

function bold() {
    if (canvas.getActiveObject()) {
        if (canvas.getActiveObject().get("fontWeight") === "bold") {
            canvas.getActiveObject().set("fontWeight", "normal");
        } else {
            canvas.getActiveObject().set("fontWeight", "bold");
        }
        canvas.renderAll();
        checkChangesOnSelect(canvas.getActiveObject());
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}


function italic() {
    if (canvas.getActiveObject()) {
        if (canvas.getActiveObject().get("fontStyle") === "italic") {
            canvas.getActiveObject().set("fontStyle", "normal");
        } else {
            canvas.getActiveObject().set("fontStyle", "italic");
        }
        canvas.renderAll();
        checkChangesOnSelect(canvas.getActiveObject());
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}


function textAlign(position) {
    if (canvas.getActiveObject()) {
        canvas.getActiveObject().setTextAlign(position);
        canvas.renderAll();
        checkChangesOnSelect(canvas.getActiveObject());
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}

function changeFontSize(val) {
    if (canvas.getActiveObject()) {
        let fontSize = parseInt(val.value);
        canvas.getActiveObject().setFontSize(fontSize);
        canvas.renderAll();
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}


function changeRotation(val) {
    if (canvas.getActiveObject()) {
        let degree = parseInt(val.value);
        canvas.getActiveObject().angle(degree)
        canvas.renderAll();
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}

canvas.on('object:rotating', function (options) {
    if (options.target) {
        rotation_input.val((options.target.angle).toFixed(0));
    }
});


function changeFontType(val) {
    if (canvas.getActiveObject()) {
        canvas.getActiveObject().setFontFamily(val.value);
        canvas.renderAll();
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}


function changeTextColor(val) {
    if (canvas.getActiveObject()) {
        canvas.getActiveObject().setFill(val.value);
        canvas.renderAll();
        checkChangesOnSelect(canvas.getActiveObject());
    } else {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
    }
}


//Responsive page design area

function doResize() {
    let width, height, elHeight, elWidth, scaleRatio;
    width = responsive_container.width() - 50;
    height = responsive_container.height() - 100;
    elHeight = design_area.outerHeight();
    elWidth = design_area.outerWidth();
    scaleRatio = Math.min(width / elWidth, height / elHeight);
    scaleRatio = scaleRatio < 0.5 ? 0.5 : scaleRatio;
    canvas.setDimensions({width: canvas.getWidth() * scaleRatio, height: canvas.getHeight() * scaleRatio});
    canvas.setZoom(canvas.getZoom() * scaleRatio);
    console.log("New Canvas Scale : " + canvas.getZoom() * scaleRatio);

}


$(window).resize(function () {
    doResize();
});


//Side Bar Toggle
let sidebar_toggle = true;

function toggleSideBar() {
    sidebar_toggle = !sidebar_toggle;
    if (sidebar_toggle) {
        $('#side-bar-overlay').show();
        $('#side-bar').animate({height: '70%'});
    } else {
        $('#side-bar-overlay').hide();
        $('#side-bar').animate({height: 0});
    }
}


function toggleSideBarDesktop() {
    sidebar_toggle = !sidebar_toggle;
    if (sidebar_toggle) {
        $('#side-bar').animate({right: '0'}).removeClass('closed');
        $('#content').animate({width: '-=300px'});
    } else {
        $('#side-bar').animate({right: '-300px'}).addClass('closed');
        $('#content').animate({width: '100%'});
    }
}

//Keyboard Shortcuts
$('html').keyup(function (e) {
    if (e.keyCode === 46) {
        deleteElement();
    }

    if (e.ctrlKey && e.keyCode === 90) {
        undo()
    }

    if (e.ctrlKey && e.keyCode === 89) {
        redo()
    }
});

function toggleLockObject() {
    if (!canvas.getActiveObject()) {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
        return;
    }
    if (canvas.getActiveObject().get("lockMovementY") === false) {
        canvas.getActiveObject().set("hasControls", false);
        canvas.getActiveObject().set("lockMovementX", true);
        canvas.getActiveObject().set("lockMovementY", true);
        canvas.getActiveObject().set("lockScalingX", true);
        canvas.getActiveObject().set("lockScalingY", true);
        canvas.getActiveObject().set("lockRotation", true);
    } else {
        canvas.getActiveObject().set("hasControls", true);
        canvas.getActiveObject().set("lockMovementX", false);
        canvas.getActiveObject().set("lockMovementY", false);
        canvas.getActiveObject().set("lockScalingX", false);
        canvas.getActiveObject().set("lockScalingY", false);
        canvas.getActiveObject().set("lockRotation", false);
    }
    canvas.discardActiveObject();
    canvas.renderAll();
    checkChangesOnSelect(canvas.getActiveObject());
}
function toggleGroup() {
    if (!canvas.getActiveObject()) {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
        return;
    }
    if (canvas.getActiveObject().type !== 'activeSelection') {
        ungroup();
    }else{
        group();
    }
    checkChangesOnSelect(canvas.getActiveObject());
}

function group() {
    if (canvas.getActiveObject().type !== 'activeSelection') {
        return;
    }
    canvas.getActiveObject().toGroup();
    canvas.requestRenderAll();
}

function ungroup() {
    if (canvas.getActiveObject().type !== 'group') {
        return;
    }
    canvas.getActiveObject().toActiveSelection();
    canvas.requestRenderAll();
}

function toFront() {
    if (!canvas.getActiveObject()) {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
        return;
    }

    canvas.bringToFront(canvas.getActiveObject());
    canvas.discardActiveObject();
    canvas.renderAll();
}


function toBack() {
    if (!canvas.getActiveObject()) {
        Toast.fire({
            icon: 'error',
            title: 'الرجاء تحديد العنصر أولاً!'
        })
        return;
    }
    canvas.sendToBack(canvas.getActiveObject());
    canvas.discardActiveObject();
    canvas.renderAll();
}

function undo() {
    canvas.undo();
}

function redo() {
    canvas.redo();
}

function download(url, name) {
    $('<a>').attr({href: url, download: name})[0].click();
}

function exportToPNG() {
    canvas.discardActiveObject().renderAll();
    download(canvas.toDataURL({format: 'png'}), 'sasss1.png');
}


function loadJson() {
    let json = "{\"version\":\"5.2.1\",\"objects\":[{\"type\":\"i-text\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112,\"top\":151,\"width\":230.05,\"height\":228.71,\"fill\":\"#333\",\"stroke\":null,\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"fontFamily\":\"Helvetica\",\"fontWeight\":\"normal\",\"fontSize\":40,\"text\":\"lorem ipsum\\ndolor\\nsit Amet\\nconsectetur\",\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"left\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"textBackgroundColor\":\"\",\"charSpacing\":0,\"styles\":[{\"start\":0,\"end\":1,\"style\":{\"fill\":\"red\",\"fontSize\":20}},{\"start\":1,\"end\":2,\"style\":{\"fill\":\"red\",\"fontSize\":30}},{\"start\":2,\"end\":3,\"style\":{\"fill\":\"red\",\"fontSize\":40}},{\"start\":3,\"end\":4,\"style\":{\"fill\":\"red\",\"fontSize\":50}},{\"start\":4,\"end\":11,\"style\":{\"fill\":\"red\",\"fontSize\":60}},{\"start\":13,\"end\":16,\"style\":{\"fill\":\"green\",\"fontStyle\":\"italic\",\"textDecoration\":\"underline\"}},{\"start\":16,\"end\":19,\"style\":{\"fill\":\"blue\",\"fontWeight\":\"bold\"}},{\"start\":20,\"end\":24,\"style\":{\"fontFamily\":\"Courier\",\"textDecoration\":\"line-through\"}},{\"start\":24,\"end\":29,\"style\":{\"fontFamily\":\"Impact\",\"fill\":\"#666\",\"textDecoration\":\"line-through\"}}],\"direction\":\"ltr\",\"path\":null,\"pathStartOffset\":0,\"pathSide\":\"left\",\"pathAlign\":\"baseline\"},{\"type\":\"i-text\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":400,\"top\":150,\"width\":124.53,\"height\":150.06,\"fill\":\"#333\",\"stroke\":null,\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"fontFamily\":\"Helvetica\",\"fontWeight\":\"normal\",\"fontSize\":40,\"text\":\"foo bar\\nbaz\\nquux\",\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"left\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"textBackgroundColor\":\"\",\"charSpacing\":0,\"styles\":[{\"start\":0,\"end\":3,\"style\":{\"fill\":\"red\"}},{\"start\":10,\"end\":14,\"style\":{\"fill\":\"blue\"}}],\"direction\":\"ltr\",\"path\":null,\"pathStartOffset\":0,\"pathSide\":\"left\",\"pathAlign\":\"baseline\"},{\"type\":\"path\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":425,\"top\":22,\"width\":357.09,\"height\":543.6,\"fill\":\"rgb(0,0,0)\",\"stroke\":null,\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":7,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"path\":[[\"M\",73.23,146.95],[\"C\",70.76,149.07999999999998,64.12,155.36999999999998,64.12,161.44],[\"C\",64.12,163.82,64.94,166.87,66.01,169.82],[\"C\",61.690000000000005,170.25,59.07000000000001,170.66,59.07000000000001,170.66],[\"C\",59.07000000000001,170.66,55.91000000000001,198.37,63.88000000000001,211.59],[\"C\",62.45000000000001,213.89000000000001,60.290000000000006,217.72,59.62000000000001,220.87],[\"C\",58.59000000000001,225.71,60.28000000000001,238.68,62.38000000000001,246.93],[\"C\",64.48,255.18,81.52000000000001,291.89,81.52000000000001,291.89],[\"L\",81.52000000000001,305.37],[\"L\",88.57000000000001,318.14],[\"C\",88.18,320.34999999999997,87.12,327.53,88.71000000000001,333.88],[\"C\",90.72000000000001,341.93,122.92000000000002,352.04,147.53,352.04],[\"C\",150.49,352.04,154.48,351.77000000000004,157.12,351.5],[\"C\",178.98000000000002,349.24,185.27,342.62,186.97,340.4],[\"C\",193.88,338.96999999999997,244.71,328.38,262.25,315.17999999999995],[\"C\",281.96,300.34,297.40999999999997,277.53,287.08,240.94999999999993],[\"C\",287.82,241.08999999999992,288.53999999999996,241.17999999999992,289.22999999999996,241.17999999999992],[\"C\",289.55999999999995,241.17999999999992,289.89,241.17999999999992,290.2,241.11999999999992],[\"C\",298.13,239.85999999999993,300.4,231.67999999999992,301.14,231.01999999999992],[\"C\",301.77,230.45999999999992,322.72999999999996,220.86999999999992,327.71999999999997,214.36999999999992],[\"C\",333.46999999999997,206.86999999999992,333.15999999999997,186.25999999999993,332.79999999999995,178.5999999999999],[\"C\",333.86999999999995,178.8599999999999,334.85999999999996,179.0399999999999,335.74999999999994,179.1299999999999],[\"C\",342.61999999999995,156.80999999999992,358.1499999999999,55.55999999999992,269.66999999999996,14.339999999999918],[\"C\",270.56999999999994,11.289999999999917,268.71999999999997,7.399999999999918,265.02,5.069999999999919],[\"C\",260.78,2.3999999999999186,255.73,2.7899999999999188,253.73999999999998,5.939999999999919],[\"C\",253.39,6.499999999999918,253.15999999999997,7.109999999999919,253.04,7.7399999999999185],[\"C\",173.14,-18.900000000000084,112.15,29.849999999999916,105.60999999999999,53.609999999999914],[\"C\",78.40999999999998,50.169999999999916,33.65999999999998,45.929999999999914,23.029999999999987,55.959999999999916],[\"C\",23.029999999999987,55.959999999999916,-2.470000000000013,71.49999999999991,0.19999999999998863,109.40999999999991],[\"C\",3.189999999999989,151.74999999999991,56.179999999999986,139.3899999999999,73.17999999999999,134.30999999999992],[\"L\",73.23,146.95],[\"z\"],[\"M\",78.2,149.8],[\"C\",80.19,145.09,80.19,120.32000000000001,80.19,120.32000000000001],[\"L\",80.19,120.32000000000001],[\"C\",81.8,110.97000000000001,84.62,97.69000000000001,89.1,85.47],[\"C\",108.72,107.77,130.43,139.44,178.6,137.65],[\"C\",208.57999999999998,136.54,238.07,127.39,238.07,127.39],[\"C\",238.07,127.39,265.43,145.04,291.93,159.74],[\"L\",220.5,172.27],[\"C\",220.11,170.35000000000002,219.62,168.60000000000002,219.04,167.08],[\"C\",214.57999999999998,155.48000000000002,203.95,155.71,177.41,157.27],[\"C\",162.23,158.16,147.35999999999999,162.19,137.41,165.48000000000002],[\"L\",128.65,158.76000000000002],[\"L\",125.27000000000001,158.94000000000003],[\"L\",131.12,167.68000000000004],[\"C\",127.43,169.05000000000004,125.27000000000001,169.98000000000005,125.27000000000001,169.98000000000005],[\"C\",125.27000000000001,169.98000000000005,107.89000000000001,170.34000000000006,109.62,170.63000000000005],[\"C\",106.15,170.01000000000005,102.60000000000001,169.58000000000004,99.07000000000001,169.29000000000005],[\"L\",100.41000000000001,160.54000000000005],[\"L\",98.03000000000002,158.94000000000005],[\"L\",93.07000000000002,168.93000000000006],[\"C\",85.09000000000002,168.60000000000005,77.52000000000002,168.90000000000006,71.56000000000002,169.34000000000006],[\"C\",70.41000000000001,166.40000000000006,69.49000000000002,163.42000000000007,69.49000000000002,161.44000000000005],[\"C\",69.48,158.06,77.06,152.49,78.2,149.8],[\"M\",170.66,168.58],[\"L\",178.29999999999998,168.58],[\"L\",204.17,184.34],[\"L\",202.39,185.72],[\"L\",170.66,168.58],[\"z\"],[\"M\",196.14,187.31],[\"L\",192.86999999999998,191.83],[\"L\",162.64,171.55],[\"L\",166.33999999999997,171.55],[\"L\",196.14,187.31],[\"z\"],[\"M\",202.91,180.15],[\"L\",185.15,168.24],[\"L\",189.63,168.24],[\"L\",204.82,177.49],[\"L\",202.91,180.15],[\"z\"],[\"M\",325.07,212.34],[\"C\",320.32,218.53,300.32,226.98000000000002,299.53999999999996,227.68],[\"C\",298.53,228.58,296.01,231.4,295.37999999999994,232.73000000000002],[\"C\",294.19999999999993,235.20000000000002,293.5899999999999,235.74,289.50999999999993,236.22000000000003],[\"C\",283.93999999999994,236.86,276.1599999999999,231.51000000000002,275.66999999999996,229.95000000000002],[\"C\",275.18999999999994,228.39000000000001,280.22999999999996,213.51000000000002,280.22999999999996,213.51000000000002],[\"L\",279.66999999999996,213.29000000000002],[\"L\",270.89,232.19000000000003],[\"L\",271.4,232.60000000000002],[\"C\",271.65,232.8,274.88,235.38000000000002,278.90999999999997,237.66000000000003],[\"C\",291.9,273.75,275.88,297.96000000000004,258.21,311.98],[\"C\",242.95999999999998,324.08000000000004,201.98,332.46000000000004,191.54999999999998,334.44],[\"L\",188.73999999999998,325.19],[\"L\",186.99999999999997,325.19],[\"L\",183.82999999999998,337.2],[\"C\",181.67,339.63,174.96999999999997,344.94,156.70999999999998,346.83],[\"C\",130.24999999999997,349.58,93.74999999999997,335.81,92.36999999999998,330.32],[\"C\",90.70999999999998,323.68,92.95999999999998,317.56,92.97999999999998,317.48],[\"L\",93.11999999999998,316.83000000000004],[\"C\",93.11999999999998,316.83000000000004,86.98999999999998,308.35,86.20999999999998,303.45000000000005],[\"C\",85.42999999999998,298.55000000000007,86.62999999999998,296.39000000000004,86.87999999999998,291.82000000000005],[\"C\",87.12999999999998,287.26000000000005,67.47999999999999,252.11000000000004,65.87999999999998,246.02000000000004],[\"C\",64.27999999999999,239.93000000000004,64.07999999999998,224.69000000000005,64.79999999999998,221.94000000000005],[\"C\",65.22999999999999,220.32000000000005,66.97999999999999,218.41000000000005,68.79999999999998,216.77000000000007],[\"C\",76.31999999999998,221.52000000000007,86.63999999999999,217.61000000000007,93.18999999999998,214.11000000000007],[\"L\",86.86999999999998,250.71000000000006],[\"L\",93.77999999999997,256.2800000000001],[\"L\",94.59999999999997,265.2000000000001],[\"L\",111.95999999999997,262.1900000000001],[\"L\",112.51999999999997,256.2800000000001],[\"C\",112.51999999999997,256.2800000000001,129.61999999999998,251.67000000000007,131.24999999999997,250.48000000000008],[\"C\",132.87999999999997,249.29000000000008,132.73999999999998,242.90000000000006,131.24999999999997,240.27000000000007],[\"C\",129.75999999999996,237.64000000000007,125.44999999999997,239.33000000000007,125.44999999999997,239.33000000000007],[\"L\",125.44999999999997,244.68000000000006],[\"L\",111.39999999999998,246.46000000000006],[\"C\",111.39999999999998,246.46000000000006,93.73999999999998,250.02000000000007,92.55999999999997,245.79000000000008],[\"C\",91.77999999999997,243.00000000000009,100.09999999999998,208.51000000000008,100.09999999999998,208.51000000000008],[\"C\",101.31999999999998,204.96000000000006,104.03999999999998,196.76000000000008,104.26999999999998,193.54000000000008],[\"C\",104.56999999999998,189.38000000000008,102.26999999999998,185.85000000000008,109.91999999999999,185.22000000000008],[\"C\",124.26999999999998,184.0300000000001,122.15999999999998,188.98000000000008,123.00999999999999,196.61000000000007],[\"L\",122.94,196.57000000000008],[\"L\",118.53999999999999,226.60000000000008],[\"L\",128.35,229.52000000000007],[\"L\",134.84,214.69000000000005],[\"C\",155.87,228.55000000000007,200.32,216.85000000000005,211.31,210.49000000000007],[\"C\",218.66,206.24000000000007,221.6,194.07000000000005,221.54,182.89000000000007],[\"L\",288.45,166.22000000000008],[\"C\",282.84999999999997,171.92000000000007,279.74,179.60000000000008,279.61,184.00000000000009],[\"L\",281.27000000000004,184.6500000000001],[\"C\",283.09000000000003,180.0200000000001,289.09000000000003,167.00000000000009,299.83000000000004,163.38000000000008],[\"L\",302.62000000000006,162.6800000000001],[\"C\",304.3500000000001,162.3900000000001,306.18000000000006,162.3400000000001,308.12000000000006,162.6100000000001],[\"C\",322.20000000000005,164.4800000000001,328.08000000000004,174.3900000000001,328.7800000000001,175.6700000000001],[\"C\",329,178.05,331.35,204.15,325.07,212.34],[\"M\",334.54,166.59],[\"L\",333.72,166.57],[\"C\",327.05,164.45999999999998,255.93,127.74,244.52000000000004,120.27],[\"L\",259.23,114.00999999999999],[\"C\",272.34000000000003,122.60999999999999,329.24,160.91,335.64,164.57],[\"L\",334.54,166.59],[\"z\"],[\"M\",159.79,40.87],[\"C\",161.66,38.629999999999995,153.76999999999998,33.73,141.73,33.959999999999994],[\"C\",145.84,29.429999999999993,166.94,29.279999999999994,173.62,26.159999999999993],[\"C\",178.79,23.739999999999995,177.41,16.119999999999994,159.57,15.009999999999993],[\"C\",203.13,2.369999999999992,254.42,33.43999999999999,254.42,33.43999999999999],[\"C\",254.42,33.43999999999999,250.41,20.059999999999988,234.92999999999998,12.47999999999999],[\"C\",282.19,21.39999999999999,299.62,52.46999999999999,309.87,68.97],[\"C\",320.13,85.47,331.28000000000003,129.18,326.48,142.22],[\"C\",328.71000000000004,114.19,293.96000000000004,38.41,259.91,26.819999999999993],[\"C\",264.82000000000005,32.46999999999999,276.41,63.61999999999999,275.52000000000004,70.16],[\"C\",255.29000000000005,18.269999999999996,185.55000000000004,25.339999999999996,184.31000000000006,27.049999999999997],[\"C\",197.39000000000007,29.129999999999995,232.46000000000006,44.44,242.06000000000006,64.96],[\"C\",226.60000000000005,41.8,179.62000000000006,38.419999999999995,179.62000000000006,38.419999999999995],[\"L\",170.65000000000006,44.3],[\"L\",199.03000000000006,61.17],[\"C\",199.03000000000006,61.17,150.64000000000004,48.68,149.08000000000004,52.25],[\"C\",147.52000000000004,55.82,206.84000000000003,75.72,223.11000000000004,96.85],[\"C\",187.33000000000004,74.38,132.63000000000005,54.14999999999999,112.73000000000005,50.46999999999999],[\"C\",123.44,45.44,158.67,42.21,159.79,40.87],[\"M\",16,66.92],[\"L\",15.6,66.51],[\"C\",24.53,57.760000000000005,35.83,54.160000000000004,47.92,54.85000000000001],[\"C\",67.08,55.96000000000001,87.03,68.29,105.95,91.70000000000002],[\"C\",138.27,131.69000000000003,168.41,140.92000000000002,234.26999999999998,124.57000000000002],[\"L\",234.92,126.00000000000003],[\"C\",213.81,131.24000000000004,195.79,134.50000000000003,179.67999999999998,134.50000000000003],[\"C\",150.21999999999997,134.50000000000003,127.13999999999999,123.59000000000003,103.15999999999998,93.93000000000004],[\"C\",85.16,71.66,65.4,58.81,47.52,57.77],[\"C\",36.47,57.13,24.2,58.89,16,66.92],[\"M\",325.48,181.66],[\"C\",325.77000000000004,183.15,324.25,183.71,324.25,183.71],[\"C\",324.25,183.71,315.67,177.8,311.2,179.14000000000001],[\"C\",306.74,180.48000000000002,301.39,189.4,304.96,192.67000000000002],[\"C\",308.53,195.94000000000003,306.45,204.56,306.45,204.56],[\"L\",297.83,208.53],[\"L\",295.75,215.86],[\"L\",287.58,217.64000000000001],[\"L\",287.58,208.53000000000003],[\"L\",294.56,205.15000000000003],[\"L\",294.56,196.58000000000004],[\"L\",287.58,191.47000000000003],[\"C\",287.58,191.47000000000003,305.56,172.14000000000004,312.11,171.55],[\"C\",318.64,170.96,325.18,180.17,325.48,181.66],[\"M\",154.15,272.69],[\"C\",152.70000000000002,271.86,114.75,273.69,114.75,273.69],[\"L\",94.46000000000001,273.91],[\"L\",90.89000000000001,279.70000000000005],[\"C\",90.89000000000001,279.70000000000005,92.68000000000002,289.11000000000007,97.73000000000002,289.30000000000007],[\"C\",110.89000000000001,289.81000000000006,151.25000000000003,302.9800000000001,151.25000000000003,302.9800000000001],[\"L\",161.66000000000003,294.6500000000001],[\"L\",159.28000000000003,280.9700000000001],[\"C\",159.27,280.97,155.6,273.52,154.15,272.69],[\"M\",148.53,286.62],[\"L\",106.18,280.89],[\"C\",106.18,280.89,104.17,278.96,106,278.90999999999997],[\"C\",115.59,278.65999999999997,146.84,278.55999999999995,148.53,278.36999999999995],[\"C\",148.97,280.82,148.53,286.62,148.53,286.62],[\"M\",138.75,229.53],[\"L\",198.51,255.25],[\"L\",191.07999999999998,280.97],[\"C\",191.07999999999998,280.97,189.13,266.6,186.01999999999998,260.75],[\"C\",182.92,254.9,138.73999999999998,232.87,138.73999999999998,232.87],[\"L\",138.73999999999998,229.53],[\"z\"],[\"M\",107.16,308.47],[\"L\",146.63,318.5],[\"L\",139.99,325.19],[\"L\",107.16000000000001,312.93],[\"L\",107.16000000000001,308.47],[\"z\"],[\"M\",249.21,226.19],[\"C\",247.43,240.29,243.86,289.74,215.76,302.98],[\"C\",233.14999999999998,272.13,221.53,247.82000000000002,221.53,247.82000000000002],[\"C\",221.53,247.82000000000002,232.26,246.79,249.21,226.19],[\"M\",332.95,316.83],[\"C\",324.34999999999997,324.89,316.15999999999997,333.87,309.73,345.9],[\"C\",306.95000000000005,351.09999999999997,226.8,393.10999999999996,224.97000000000003,398.71],[\"C\",223.14000000000001,404.31,299.06000000000006,360.25,301.91,365.40999999999997],[\"C\",304.95000000000005,370.90999999999997,301.27000000000004,387.30999999999995,300.94,390.67999999999995],[\"C\",298.29,417.84,209.89,440.9599999999999,200.59,463.53],[\"C\",195.79,475.2,109.94,486.51,107.23,491.47999999999996],[\"C\",103.61,498.10999999999996,154.32,481.46999999999997,153.18,487.02],[\"C\",150.11,502.09,136.35000000000002,527.13,130.93,532.43],[\"C\",124.62,538.6099999999999,116.29,530.5799999999999,106.48,542.4],[\"C\",106.48,542.4,99.5,547.31,98.45,537.27],[\"C\",97.01,523.49,76.38,488.88,65.22,477.72999999999996],[\"C\",60.76,473.27,89.3,483.30999999999995,86.55,475.28],[\"C\",86.55,475.28,74.8,470.59999999999997,56.3,465.90999999999997],[\"C\",36.199999999999996,460.82,63.66,445.39,63.66,445.39],[\"C\",63.66,445.39,78.53,442.74,54.29,431.78999999999996],[\"C\",43.71,427,80.92,410.6,79.06,400.57],[\"C\",78.10000000000001,395.37,135.77,423.38,136.15,410.83],[\"C\",136.25,407.7,105.02000000000001,407.88,73.58000000000001,387.99],[\"L\",48.06000000000002,365.11],[\"C\",48.06000000000002,365.11,54.990000000000016,336.49,45.680000000000014,323.78000000000003],[\"C\",50.65000000000001,314.39000000000004,62.88000000000001,316.83000000000004,74.22000000000001,305.94000000000005],[\"C\",75.92000000000002,306.89000000000004,81.87000000000002,314.64000000000004,81.95000000000002,318.13000000000005],[\"C\",82.17000000000002,327.95000000000005,80.22000000000001,338.52000000000004,85.22000000000001,340.7300000000001],[\"C\",119.38000000000001,361.0100000000001,150.63,363.0300000000001,194.34000000000003,346.38000000000005],[\"C\",259.31000000000006,333.59000000000003,284.24,311.6600000000001,291.57000000000005,300.30000000000007],[\"C\",304.53000000000003,280.2100000000001,296.63000000000005,245.76000000000008,296.63000000000005,245.76000000000008],[\"C\",296.63000000000005,245.76000000000008,317.88000000000005,230.87000000000006,334.83000000000004,236.2800000000001],[\"C\",339.38000000000005,238.6400000000001,339.09000000000003,248.97000000000008,342.41,256.1500000000001],[\"C\",344.41,260.4600000000001,353.99,268.9400000000001,356.24,270.7900000000001],[\"C\",360.27,275.02,349.56,301.27,332.95,316.83]]},{\"type\":\"path\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":130,\"top\":378,\"width\":180.42,\"height\":170.37,\"fill\":\"\",\"stroke\":\"red\",\"strokeWidth\":4,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"path\":[[\"M\",10,150],[\"C\",7.238576250846028,133.4314575050762,18.43145750507619,117.76142374915398,34.999999999999986,115],[\"C\",51.56854249492379,112.23857625084604,67.238576250846,123.43145750507617,69.99999999999999,139.99999999999997],[\"C\",71.65685424949238,167.61423749153968,86.4314575050762,187.76142374915398,103,185],[\"C\",119.5685424949238,182.23857625084602,131.65685424949237,157.61423749153968,130,130],[\"C\",129.24688443204892,69.24867751861274,142.06782114143982,17.76142374915399,158.63636363636363,15.000000000000014],[\"C\",175.20490613128743,12.238576250846037,189.24688443204892,59.248677518612695,190,119.99999999999997]]},{\"type\":\"rect\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":251,\"top\":44,\"width\":80,\"height\":80,\"fill\":{\"type\":\"linear\",\"coords\":{\"x1\":0,\"y1\":0,\"x2\":1,\"y2\":0},\"colorStops\":[{\"offset\":1,\"color\":\"rgb(0,0,0)\",\"opacity\":1},{\"offset\":0,\"color\":\"rgb(255,255,255)\",\"opacity\":1}],\"offsetX\":0,\"offsetY\":0,\"gradientUnits\":\"percentage\",\"gradientTransform\":[1,0,0,1,0,0]},\"stroke\":\"blue\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0},{\"type\":\"ellipse\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":44,\"top\":25,\"width\":170,\"height\":110,\"fill\":{\"type\":\"linear\",\"coords\":{\"x1\":0,\"y1\":0,\"x2\":0,\"y2\":1},\"colorStops\":[{\"offset\":1,\"color\":\"rgb(255,255,0)\",\"opacity\":1},{\"offset\":0,\"color\":\"rgb(255,0,0)\",\"opacity\":1}],\"offsetX\":0,\"offsetY\":0,\"gradientUnits\":\"percentage\",\"gradientTransform\":[1,0,0,1,0,0]},\"stroke\":null,\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":2,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"rx\":85,\"ry\":55},{\"type\":\"group\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":1,\"top\":396,\"width\":200,\"height\":200,\"fill\":\"rgb(0,0,0)\",\"stroke\":null,\"strokeWidth\":0,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":-1,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"objects\":[{\"type\":\"circle\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-100.5,\"top\":-100.5,\"width\":200,\"height\":200,\"fill\":\"#FF0000\",\"stroke\":null,\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"radius\":100,\"startAngle\":0,\"endAngle\":360},{\"type\":\"rect\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-90.5,\"top\":-90.5,\"width\":155.56,\"height\":70.71,\"fill\":\"#ff00ff\",\"stroke\":null,\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0}]},{\"type\":\"image\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":362,\"top\":342,\"width\":384,\"height\":206,\"fill\":\"rgb(0,0,0)\",\"stroke\":null,\"strokeWidth\":0,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":-5,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"cropX\":0,\"cropY\":0,\"src\":\"http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4\",\"crossOrigin\":\"anonymous\",\"filters\":[]},{\"type\":\"image\",\"version\":\"5.2.1\",\"originX\":\"left\",\"originY\":\"top\",\"left\":490,\"top\":330,\"width\":600,\"height\":600,\"fill\":\"rgb(0,0,0)\",\"stroke\":null,\"strokeWidth\":0,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeUniform\":false,\"strokeMiterLimit\":4,\"scaleX\":0.72,\"scaleY\":0.72,\"angle\":-4,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"skewX\":0,\"skewY\":0,\"cropX\":0,\"cropY\":0,\"src\":\"http://fabricjs.com/assets/printio.png\",\"crossOrigin\":null,\"filters\":[]}]}";
    canvas.clear();
    canvas.loadFromJSON(json, function () {
        canvas.renderAll();
    })
}

/*
loadJson();
*/


function do_save() {
    console.log('loading');
    canvas.clear();

    let url = "../../images/uploads/card.svg";


    fabric.loadSVGFromURL(url, function (
        objects,
        options,
        elements,
    ) {
        objects.forEach(function (obj, index) {
            if (obj["type"] === "image") {
                if (obj["id"].toUpperCase() === "BACKGROUND") {
                    fabric.Image.fromURL(obj['xlink:href'], function (img) {
                        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
                    }, {crossOrigin: 'anonymous'});
                } else {
                    // obj.setSrc('assets/icons/'+obj.getSrc());
                    obj.set({
                        selectable: true,
                        evented: true
                    });
                    canvas.add(obj).renderAll();
                }
            } else if (obj["type"] === "text") {
                let element = elements[index];
                let childrens = [].slice.call(element.childNodes);
                let value = "";
                childrens.forEach(function (el, index, array) {
                    if (el.nodeName === "tspan") {
                        value += el.childNodes[0].nodeValue;
                    } else if (el.nodeName === "#text") {
                        value += el.nodeValue;
                    }

                    if (index < childrens.length - 1) {
                        value += "\n";
                    }
                });

                value =
                    obj["text-transform"] === "uppercase"
                        ? value.toUpperCase()
                        : value;

                let text = new fabric.IText(obj.text, obj.toObject());
                text.set({
                    text: value,
                    type: 'i-text'
                });

                let left;
                let _textAlign = obj.get("textAnchor")
                    ? obj.get("textAnchor")
                    : "left";
                switch (_textAlign) {
                    case "center":
                        left = obj.left - text.getScaledWidth() / 2;
                        break;
                    case "right":
                        left = obj.left - text.getScaledWidth();
                        break;
                    default:
                        left = obj.left;
                        break;
                }

                text.set({
                    left: left,
                    textAlign: _textAlign
                });
                canvas.add(text).renderAll();
            } else {
                canvas.add(obj).renderAll();
            }
        });

        canvas.setWidth(options.width);
        canvas.setHeight(options.height);
        canvas.setZoom(1);
        canvas.calcOffset();
    });
}
