package com.example.jay.appfillbelly;

import android.app.Activity;
import android.content.DialogInterface;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;
import android.widget.EditText;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.rengwuxian.materialedittext.MaterialEditText;

public class SignUp extends AppCompatActivity {


    EditText edtNewEmail,edtNewName;
    public Button btnSignUp;
    FirebaseDatabase database;
    DatabaseReference users;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);

        edtNewName = (EditText)findViewById(R.id.edtName);
        edtNewEmail = (EditText)findViewById(R.id.edtEmail);

        btnSignUp = (Button)findViewById(R.id.btnSignUp);

        database  = FirebaseDatabase.getInstance();
        users = database.getReference("Users");



    }

    private void SignupProcess() {
        Log.d("dialog", "showSignupDialog: ");
        boolean iserror = false;
        if (edtNewName.getText().toString().equals(""))
        {
            iserror = true;

        }
        else if (edtNewEmail.getText().toString().equals(""))
        {
            iserror = true;
        }
        if (iserror)
        {
            AlertDialog alertDialog = new AlertDialog.Builder(SignUp.this).create();
            alertDialog.setTitle("Something went wrong");
            alertDialog.setMessage("Please fill all the information");
            alertDialog.setButton(AlertDialog.BUTTON_NEUTRAL, "OK",
                    new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            dialog.dismiss();
                        }
                    });
            alertDialog.show();
        }
        else
        {
            Log.d("dialog", "showSignupDialog: actual data "+edtNewEmail.getText().toString());
            final Person person = new Person(edtNewName.getText().toString(),edtNewEmail.getText().toString());

            users.addListenerForSingleValueEvent(new ValueEventListener() {
                @Override
                public void onDataChange(DataSnapshot dataSnapshot) {

                    if(dataSnapshot.child(String.valueOf(person.name)).exists())
                        Toast.makeText(SignUp.this, "User already exists", Toast.LENGTH_SHORT).show();
                    else
                    {
                        users.child(person.name)
                                .setValue(person);
                        Toast.makeText(SignUp.this, "Successful registration", Toast.LENGTH_SHORT).show();
                    }
                }

                @Override
                public void onCancelled(DatabaseError databaseError) {

                }
            });

        }

    }

    public void onClickSignup(View view)
    {
        Log.d("dialog", "onClickSignup: clicked !");
        SignupProcess();
    }

}
