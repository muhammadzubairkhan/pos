// Footer Scripts

// CALCULATOR
try
{
    var discountflag = 0;
    var btn = document.getElementById("bill_btn");
    var btn1 = document.getElementById("bill_btn_takeaway");

    // Get the modal
    var span = document.getElementsByClassName("close")[0];
    var modal = document.getElementById('myModal');
    
    btn.onclick = function() 
    {
        modal.style.display = "block";
        var p_name = $("#orders li div #p_name");
        var quanbox = $('#orders li div #val');
        var pricebox = $('#orders li #pricebox h4');
        var discount = $('#orders li #discounted_amount h4');
        
        $("#table_products").html("");

        for(var i = 0;i<p_name.length;i++)
        {
            //(p_name.get(i).innerHTML);
            $("#table_products").append('<tr><td>'+p_name.get(i).innerHTML+'</td><td>'+quanbox.get(i).value+'</td><td>'+pricebox.get(i).innerHTML+'</td><td>'+discount.get(i).innerHTML+'</td></tr>');
        }

        var total = $('#totaltxt').text();
        var discount = $('#discounttxt').text();
        
        $('#modal-total').html(total);  
        $('#modal-discounttxt').html(discount);
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() 
    {
        try
        {
            modal.style.display = "none";
        }
        catch(err)
        {
            document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
            console.log("Error Trace: "+ err.stack);
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) 
    {
        try
        {
            if (event.target == modal) 
            {
                modal.style.display = "none";
            }
        }
        catch(err)
        {
            document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
            console.log("Error Trace: "+ err.stack);
        }
    }
    
    var keys = document.querySelectorAll('#calculator span');
    var operators = ['+', '-', 'x', '÷'];
    var decimalAdded = false;
    var discountedprice = 0;
    var discountpercent = 0;
    var customer_name = "";
    var customer_contact = "";
    
    // Add onclick event to all the keys and perform operations
    for(var i = 0; i < keys.length; i++) 
    {
        try
        {
            keys[i].onclick = function(e) 
            {
                // Get the input and button values
                var input = document.querySelector('.screen');
                var inputVal = input.innerHTML;
                var btnVal = this.innerHTML;

                // Now, just append the key values (btnValue) to the input string and finally use javascript's eval function to get the result
                // If clear key is pressed, erase everything

                if(btnVal == 'C') 
                {
                   input.innerHTML = '';
                   decimalAdded = false;
                }

                // If eval key is pressed, calculate and display the result

                else if(btnVal == 'Done') 
                {   
                    discountedprice = $("#modal-discounttxt").text();
                    customer_name = $("#customer_name").val();
                    customer_contact = $("#customer_contact").val();
                    
                    var customer_name_field = document.getElementById("customer_name");
                    var customer_contact_field = document.getElementById("customer_contact");
                    
                    //alert(customer_name);
                    //alert(customer_contact);
                    
                    discountpercent = parseInt(discountedprice);
                    //alert(discountpercent);
                    var total = parseInt($('#totaltxt').text());
                    var total_discounted = parseInt($('#modal-discounttxt').text());
                    var inputvalue = parseInt(input.innerHTML);

                    if(discountflag == 0)
                    {
                        var customer_div = $("#customer_info");
                        //alert(customer_div.hasClass("disabledbutton"));
                        var hasClassDisabled = customer_div.hasClass("disabledbutton");
                        
                        //alert("flag0");
                        //alert(inputvalue);
                        if(inputvalue >= total_discounted)
                        {
                            //alert("input value greater than equal to total");
                            if(ordertype != 1)
                            {
                                //alert("getbill in");
                                getbill();
                                add_customer();
                                //alert("getbill out");
                            }

                            //alert("Customer-ID: "+cust_id);
                            
                            //alert(total);
                            //alert(discountpercent);
                            //alert(discountedprice);
                            Settle(cust_id, inputvalue, Math.round(total), Math.round(discountpercent));
                            //discountedprice = 0;
                            //discountpercent = 0;
                        }
//                        else
//                        {
//                            if(customer_name == "" && customer_contact == "" && hasClassDisabled == false)
//                            {
//                                alert("Fill customer name and contact details to proceed!");
//                                customer_name_field.style.backgroundColor = "yellow";
//                                customer_name_field.style.borderColor = "red";
//                                customer_contact_field.style.backgroundColor = "yellow";
//                                customer_contact_field.style.borderColor = "red";
//                            }
//                            else
//                            {
//                                alert("Enter price equal or greater than the order price!");
//                            }
//                        }
                    }
                    else
                    {
                        //alert("flag1");
                        if(inputvalue >= discountedprice)
                        {
                            if(ordertype != 1)
                            {
                                getbill();
                            }
                            
                            //alert(total);
                            //alert(inputvalue);
                            //alert(discountpercent);
                            //alert(discountedprice);
                            
                            Settle(cust_id, inputvalue,Math.round(total), Math.round(discountpercent));
                            insertDiscount(discountpercent, total); 
                            discountedprice = 0;
                            discountpercent = 0;
                        }

                        discountflag = 0;
                    }

                }
                else if(btnVal == 'Discount') 
                {
                    var total = parseInt($('#totaltxt').text());
                    var inputvalue = parseFloat(input.innerHTML)/100;

                    discountpercent = inputvalue*total;
                    discountedprice = total - (inputvalue*total);

                    $('#modal-total').html(Math.round(total));
                    $('#modal-discounttxt').html(Math.round(discountedprice));
                    total = discountedprice;
                    discountflag = 1;
                }

                // Basic functionality of the calculator is complete. But there are some problems like
                // 1. No two operators should be added consecutively.
                // 2. The equation shouldn't start from an operator except minus
                // 3. not more than 1 decimal should be there in a number
                // We'll fix these issues using some simple checks
                // indexOf works only in IE9+

                else if(operators.indexOf(btnVal) > -1) 
                {
                      // Operator is clicked
                      // Get the last character from the equation
                      var lastChar = inputVal[inputVal.length - 1];

                      // Only add operator if input is not empty and there is no operator at the last
                      if(inputVal != '' && operators.indexOf(lastChar) == -1)
                        input.innerHTML += btnVal;

                      // Allow minus if the string is empty
                      else if(inputVal == '' && btnVal == '-')
                        input.innerHTML += btnVal;

                      // Replace the last operator (if exists) with the newly pressed operator
                      if(operators.indexOf(lastChar) > -1 && inputVal.length > 1) 
                      {
                        // Here, '.' matches any character while $ denotes the end of string, so anything (will be an operator in this case) at the end of string will get replaced by new operator
                        input.innerHTML = inputVal.replace(/.$/, btnVal);
                      }

                      decimalAdded =false;
                }

                // Now only the decimal problem is left. We can solve it easily using a flag 'decimalAdded' which we'll set once the decimal is added and prevent more decimals to be added once it's set. It will be reset when an operator, eval or clear key is pressed.
                else if(btnVal == '.') 
                {
                  if(!decimalAdded) 
                  {
                    input.innerHTML += btnVal;
                    decimalAdded = true;
                  }
                }

                // if any other key is pressed, just append it
                else 
                {
                  input.innerHTML += btnVal;
                }

                // prevent page jumps
                e.preventDefault();

            }
        }
        catch(err)
        {
            document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
            console.log("Error Trace: "+ err.stack);
        }
    }
    
}
catch(err)
{
    document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
    console.log("Error Trace: "+ err.stack);
}

//CALCULATOR

;(function(window) 
{
    try
    {
        'use strict';

        var Waves = Waves || {};
        var $$ = document.querySelectorAll.bind(document);

        // Find exact position of element
        function isWindow(obj) 
        {
            return obj !== null && obj === obj.window;
        }

        function getWindow(elem) 
        {
            return isWindow(elem) ? elem : elem.nodeType === 9 && elem.defaultView;
        }

        function offset(elem) 
        {
            var docElem, win,
                box = {top: 0, left: 0},
                doc = elem && elem.ownerDocument;

            docElem = doc.documentElement;

            if (typeof elem.getBoundingClientRect !== typeof undefined) {
                box = elem.getBoundingClientRect();
            }
            win = getWindow(doc);
            return {
                top: box.top + win.pageYOffset - docElem.clientTop,
                left: box.left + win.pageXOffset - docElem.clientLeft
            };
        }

        function convertStyle(obj) 
        {
            try
            {
                var style = '';

                for (var a in obj) 
                {
                    if (obj.hasOwnProperty(a)) 
                    {
                        style += (a + ':' + obj[a] + ';');
                    }
                }

                return style;
            }
            catch(err)
            {
                document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
                console.log("Error Trace: "+ err.stack);
            }
        }

        var Effect = {

            // Effect delay
            duration: 750,

            show: function(e, element) 
            {
                try
                {
                    // Disable right click
                    if (e.button === 2) 
                    {
                        return false;
                    }

                    var el = element || this;

                    // Create ripple
                    var ripple = document.createElement('div');
                    ripple.className = 'waves-ripple';
                    el.appendChild(ripple);

                    // Get click coordinate and element witdh
                    var pos         = offset(el);
                    var relativeY   = (e.pageY - pos.top);
                    var relativeX   = (e.pageX - pos.left);
                    var scale       = 'scale('+((el.clientWidth / 100) * 10)+')';

                    // Support for touch devices
                    if ('touches' in e) {
                      relativeY   = (e.touches[0].pageY - pos.top);
                      relativeX   = (e.touches[0].pageX - pos.left);
                    }

                    // Attach data to element
                    ripple.setAttribute('data-hold', Date.now());
                    ripple.setAttribute('data-scale', scale);
                    ripple.setAttribute('data-x', relativeX);
                    ripple.setAttribute('data-y', relativeY);

                    // Set ripple position
                    var rippleStyle = {
                        'top': relativeY+'px',
                        'left': relativeX+'px'
                    };

                    ripple.className = ripple.className + ' waves-notransition';
                    ripple.setAttribute('style', convertStyle(rippleStyle));
                    ripple.className = ripple.className.replace('waves-notransition', '');

                    // Scale the ripple
                    rippleStyle['-webkit-transform'] = scale;
                    rippleStyle['-moz-transform'] = scale;
                    rippleStyle['-ms-transform'] = scale;
                    rippleStyle['-o-transform'] = scale;
                    rippleStyle.transform = scale;
                    rippleStyle.opacity   = '1';

                    rippleStyle['-webkit-transition-duration'] = Effect.duration + 'ms';
                    rippleStyle['-moz-transition-duration']    = Effect.duration + 'ms';
                    rippleStyle['-o-transition-duration']      = Effect.duration + 'ms';
                    rippleStyle['transition-duration']         = Effect.duration + 'ms';

                    rippleStyle['-webkit-transition-timing-function'] = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
                    rippleStyle['-moz-transition-timing-function']    = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
                    rippleStyle['-o-transition-timing-function']      = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
                    rippleStyle['transition-timing-function']         = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';

                    ripple.setAttribute('style', convertStyle(rippleStyle));
                }
                catch(err)
                {
                    document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
                    console.log("Error Trace: "+ err.stack);
                }
            },

            hide: function(e) 
            {
                TouchHandler.touchup(e);

                var el = this;
                var width = el.clientWidth * 1.4;

                // Get first ripple
                var ripple = null;
                var ripples = el.getElementsByClassName('waves-ripple');
                if (ripples.length > 0) 
                {
                    ripple = ripples[ripples.length - 1];
                } 
                else 
                {
                    return false;
                }

                var relativeX   = ripple.getAttribute('data-x');
                var relativeY   = ripple.getAttribute('data-y');
                var scale       = ripple.getAttribute('data-scale');

                // Get delay beetween mousedown and mouse leave
                var diff = Date.now() - Number(ripple.getAttribute('data-hold'));
                var delay = 350 - diff;

                if (delay < 0) 
                {
                    delay = 0;
                }

                // Fade out ripple after delay
                setTimeout(function() 
                {
                    try
                    {
                        var style = {
                            'top': relativeY+'px',
                            'left': relativeX+'px',
                            'opacity': '0',

                            // Duration
                            '-webkit-transition-duration': Effect.duration + 'ms',
                            '-moz-transition-duration': Effect.duration + 'ms',
                            '-o-transition-duration': Effect.duration + 'ms',
                            'transition-duration': Effect.duration + 'ms',
                            '-webkit-transform': scale,
                            '-moz-transform': scale,
                            '-ms-transform': scale,
                            '-o-transform': scale,
                            'transform': scale,
                        };

                        ripple.setAttribute('style', convertStyle(style));

                        setTimeout(function() 
                        {
                            try 
                            {
                                el.removeChild(ripple);
                            } 
                            catch(err) 
                            {
                                document.getElementById("error_message").innerHTML = err.message;
                            }
                        }, Effect.duration);
                    }
                    catch(err)
                    {
                        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
                        console.log("Error Trace: "+ err.stack);
                    }
                }, delay);
            },

            // Little hack to make <input> can perform waves effect
            wrapInput: function(elements) 
            {
                try
                {
                    for (var a = 0; a < elements.length; a++) 
                    {
                        var el = elements[a];

                        if (el.tagName.toLowerCase() === 'input') 
                        {
                            var parent = el.parentNode;

                            // If input already have parent just pass through
                            if (parent.tagName.toLowerCase() === 'i' && parent.className.indexOf('waves-effect') !== -1) 
                            {
                                continue;
                            }

                            // Put element class and style to the specified parent
                            var wrapper = document.createElement('i');
                            wrapper.className = el.className + ' waves-input-wrapper';

                            var elementStyle = el.getAttribute('style');

                            if (!elementStyle) 
                            {
                                elementStyle = '';
                            }

                            wrapper.setAttribute('style', elementStyle);

                            el.className = 'waves-button-input';
                            el.removeAttribute('style');

                            // Put element as child
                            parent.replaceChild(wrapper, el);
                            wrapper.appendChild(el);
                        }
                    }
                }
                catch(err)
                {
                    document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
                    console.log("Error Trace: "+ err.stack);
                }
            }
        };

        /*
            Disable mousedown event for 500ms during and after touch
        */
        var TouchHandler = {
            /* uses an integer rather than bool so there's no issues with
             * needing to clear timeouts if another touch event occurred
             * within the 500ms. Cannot mouseup between touchstart and
             * touchend, nor in the 500ms after touchend. */
            touches: 0,
            allowEvent: function(e) 
            {
                try
                {
                    var allow = true;

                    if (e.type === 'touchstart') 
                    {
                        TouchHandler.touches += 1; //push
                    } 
                    else if (e.type === 'touchend' || e.type === 'touchcancel') 
                    {
                        setTimeout(function() 
                        {
                            if (TouchHandler.touches > 0) 
                            {
                                TouchHandler.touches -= 1; //pop after 500ms
                            }
                        }, 500);
                    } 
                    else if (e.type === 'mousedown' && TouchHandler.touches > 0) 
                    {
                        allow = false;
                    }

                    return allow;
                }
                catch(err)
                {
                    document.getElementById("error_message").innerHTML = err.message;
                }
            },
            touchup: function(e) 
            {
                TouchHandler.allowEvent(e);
            }
        };


        /*
            Delegated click handler for .waves-effect element.
            returns null when .waves-effect element not in "click tree"
        */

        function getWavesEffectElement(e) 
        {
            try
            {
                if (TouchHandler.allowEvent(e) === false) 
                {
                    return null;
                }

                var element = null;
                var target = e.target || e.srcElement;

                while (target.parentElement !== null) 
                {
                    if (!(target instanceof SVGElement) && target.className.indexOf('waves-effect') !== -1) 
                    {
                        element = target;
                        break;
                    } 
                    else if (target.classList.contains('waves-effect')) 
                    {
                        element = target;
                        break;
                    }
                    target = target.parentElement;
                }
                return element;
            }
            catch(err)
            {
                document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
                console.log("Error Trace: "+ err.stack);
            }
        }

        /*
            Bubble the click and show effect if .waves-effect elem was found
        */

        function showEffect(e) 
        {
            try
            {
                var element = getWavesEffectElement(e);

                if (element !== null) 
                {
                    Effect.show(e, element);

                    if ('ontouchstart' in window) 
                    {
                        element.addEventListener('touchend', Effect.hide, false);
                        element.addEventListener('touchcancel', Effect.hide, false);
                    }

                    element.addEventListener('mouseup', Effect.hide, false);
                    element.addEventListener('mouseleave', Effect.hide, false);
                }
            }
            catch(err)
            {
                document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
                console.log("Error Trace: "+ err.stack);
            }
        }

        Waves.displayEffect = function(options) 
        {
            options = options || {};

            if ('duration' in options) 
            {
                Effect.duration = options.duration;
            }

            //Wrap input inside <i> tag
            Effect.wrapInput($$('.waves-effect'));

            if ('ontouchstart' in window) 
            {
                document.body.addEventListener('touchstart', showEffect, false);
            }

            document.body.addEventListener('mousedown', showEffect, false);
        };

        /*
           Attach Waves to an input element (or any element which doesn't
           bubble mouseup/mousedown events).
           Intended to be used with dynamically loaded forms/inputs, or
           where the user doesn't want a delegated click handler.
        */

        Waves.attach = function(element) 
        {
            //FUTURE: automatically add waves classes and allow users
            // to specify them with an options param? Eg. light/classic/button

            if (element.tagName.toLowerCase() === 'input') 
            {
                Effect.wrapInput([element]);
                element = element.parentElement;
            }

            if ('ontouchstart' in window) 
            {
                element.addEventListener('touchstart', showEffect, false);
            }

            element.addEventListener('mousedown', showEffect, false);
        };

        window.Waves = Waves;

        document.addEventListener('DOMContentLoaded', function() 
        {
            Waves.displayEffect();
        }, false);

}
catch(err)
{
    document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
    console.log("Error Trace: "+ err.stack);
}
    
})(window);