<?php

namespace App\Helpers;

class MinhasFuncoesHelper
{
    public static function formulario()
    {

        $inputValue = service('request')->getCookie('emailteste');
        
        return '<form id="myForm">
                   <label for="emailteste">Digite seu e-mail para testar o envio:</label><br>
                   <input type="text" id="emailteste" name="emailteste" value="'.$inputValue.'"><br>
                   <button type="submit">Enviar</button>
                </form>

               <script>
               function setCookie(name, value, days) {
                   var expires = "";
                   if (days) {
                       var date = new Date();
                       date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                       expires = "; expires=" + date.toUTCString();
                   }
                   document.cookie = name + "=" + (value || "") + expires + "; path=/";
               }

               function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(";");
                for(var i=0;i < ca.length;i++) {
                    var c = ca[i];
                    while (c.charAt(0)==" ") c = c.substring(1,c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
                }
                return null;
                }
                
                document.getElementById("myForm").addEventListener("submit", function(event) {
                    event.preventDefault(); 
                    var emailteste = document.getElementById("emailteste").value;
                    setCookie("emailteste", emailteste, 365);
                    alert("E-mail armazenado com sucesso!");
                });
                
                window.onload = function() {
                    var savedValue = getCookie("emailteste");
                    if (savedValue) {
                        document.getElementById("emailteste").value = savedValue;
                    }
                };
            </script>';
    }

    public static function toRemove()
    {
        return 'Remover';
    }



}

