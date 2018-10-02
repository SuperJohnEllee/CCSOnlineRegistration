  function isWhitespace(text){
    return (text.trim().length == 0);
  }

  function has_Space(text) {
    return (text.split(' ').length > 1);
  }

  function hasValueof(text, gg) {
    return (text.split(gg).length > 1);
  }

  function pauseComp(millis)
  {
    var date = new Date();
    var curDate = null;

    do { curDate = new Date(); }
    while(curDate-date < millis);
  }

  function pohibitClosing(id, arguu)
  {
    $('#' + id).on('hide.bs.modal', function (e) {
      return arguu;
    });
  }

  function hasWrongspaces(txt) {
    var a = false;
    var b = txt.split(' ');
    var c = b.length;
    for(var i = 0; i < c; i++ )
    {
      if(b[i].length < 1)
      {
        a = true;
      }
    }
    return a  
  };


  function invalidNaming(txt) {
    return (haswrongspaces(txt) || isWhitespace(txt));
  }

  function isBelow(num, txt) {
    return txt.length < num;
  }

  function setSpaceToZero(the_input) {
    if(isWhitespace(the_input.value))
    {
      the_input.value = 0;
    }
  }

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  