// Change Input Direction Depend on Language
$('input[data-autodirect]').keyup(function(){
    setDirection($(this));
})
function checkRTL(s){
    var ltrChars = 'A-Za',
        rtlChars = 'u0591-u07FFuFB1D-uFDFDuFE70-uFEFC-zu00C0-u00D6u00D8-u00F6u00F8-u02B8u0300-u0590u0800-u1FFF'+'u2C00-uFB1CuFDFE-uFE6FuFEFD-uFFFF',
        rtlDirCheck = new RegExp('^[^'+ltrChars+']*['+rtlChars+']');
    return rtlDirCheck.test(s);
};
function setDirection(selector){
    var string = selector.val();
    for (var i=0; i<string.length; i++) {
        var isRTL = checkRTL( string[i] );
        var dir = isRTL ? 'LTR' : 'RTL';
        if(dir === 'RTL') var finalDirection = 'RTL';
        if(finalDirection == 'RTL') dir = 'RTL';
    }
///////////////////////////////////////////////////
    if(dir=='LTR'){
        selector.css("direction", "ltr");
    }else{
        selector.css("direction", "rtl");
    }
}