package com.example.jay.appfillbelly;

import android.widget.EditText;

/**
 * Created by vishvapatel on 10/4/17.
 */

public class Person {
    String name;
    static String Email;


    /*public Person(String s)

    {
        //empty
    }*/

    /*public String getPersonName() {
        return name;
    }

    */public void setPersonName(String name) {
        this.name = name;
    }

   /* public String getPersonEmail() {
        return Email;
    }
*/
    public void setPersonEmail(String email) {
        Email = email;
    }

    public Person(String name, String email) {

        this.name = name;
        Email = email;
    }

    public Person(String email){
        Email = email;
    }

    public static String getEmail(){
        return Email;
    }
}
