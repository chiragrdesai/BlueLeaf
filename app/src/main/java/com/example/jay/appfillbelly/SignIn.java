package com.example.jay.appfillbelly;

import android.content.DialogInterface;
import android.provider.ContactsContract;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.rengwuxian.materialedittext.MaterialEditText;

import static com.example.jay.appfillbelly.R.id.Email;
import static com.example.jay.appfillbelly.R.id.edtEmail;

public class SignIn extends AppCompatActivity {

    EditText edtUserEmail;
    public Button btnSignIn;
    FirebaseDatabase database;
    DatabaseReference users;



    public EditText getEdtUserEmail() {
        return edtUserEmail;
    }

   /* public void setEdtUserEmail(EditText edtUserEmail) {
        this.edtUserEmail = edtUserEmail;
    }*/

    public SignIn(String Email) {

    }
    public SignIn()
    {
        //empty
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_in);

        edtUserEmail = (EditText) findViewById(R.id.edtEmail);
        btnSignIn = (Button) findViewById(R.id.btnSignIn);

        }

    /*private void signIn(final String Email) {
        final SignIn user = new SignIn(edtUserEmail.getText().toString());
        users.addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                if (dataSnapshot.child(String.valueOf(user)).exists()) {
                    if (!user.isEmpty())
                    {
                        SignIn login = dataSnapshot.child(String.valueOf(user)).getValue(SignIn.class);
                        if(login.getEdtUserEmail().equals(Email))
                            Toast.makeText(SignIn.this, "Successful", Toast.LENGTH_SHORT).show();
                        else
                            Toast.makeText(SignIn.this, "Check Email", Toast.LENGTH_SHORT).show();
                    }
                    else {
                        Toast.makeText(SignIn.this, "Fields Required", Toast.LENGTH_SHORT).show();
                    }
                }
                else
                {
                    Toast.makeText(SignIn.this, "User not exist !", Toast.LENGTH_SHORT).show();
                }

            }

            @Override
            public void onCancelled(DatabaseError databaseError) {


            }
        });
    }*/

  /* private boolean isEmpty() {
        return isEmpty();
    }


    @Override
    public void onClick(View view) {
        switch(view.getId())
        {
            case R.id.btnSignIn:
                signIn(edtUserEmail.getText().toString());
                break;

        }
    }*/

    private void SigninProcess() {
        Log.d("dialog", "showSigninDialog: ");
        boolean iserror = false;
        System.out.printf(edtUserEmail.getText().toString());
        if (edtUserEmail.getText().toString().equals("")) {
            iserror = true;

        }
        if (iserror)
        {
            AlertDialog alertDialog = new AlertDialog.Builder(SignIn.this).create();
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
            Log.d("dialog", "showSigninDialog: actual data " + edtUserEmail.getText().toString());
            final Person person = new Person(edtUserEmail.getText().toString());

            users.addListenerForSingleValueEvent(new ValueEventListener() {
                @Override
                public void onDataChange(DataSnapshot dataSnapshot) {
                    if (dataSnapshot.child(String.valueOf(person)).exists()) {
                        if (!person.equals(edtUserEmail)) {
                            SignIn login = dataSnapshot.child(String.valueOf(person)).getValue(SignIn.class);
                            if (login.edtUserEmail.equals(edtEmail))
                                Toast.makeText(SignIn.this, "Successful", Toast.LENGTH_SHORT).show();
                            else
                                Toast.makeText(SignIn.this, "Check Email", Toast.LENGTH_SHORT).show();
                        } else {
                            Toast.makeText(SignIn.this, "Fields Required", Toast.LENGTH_SHORT).show();
                        }
                    } else {
                        Toast.makeText(SignIn.this, "User not exist !", Toast.LENGTH_SHORT).show();

                    }
                }

                @Override
                public void onCancelled(DatabaseError databaseError) {

                }


            });

        }
    }

    public void onClick(View view)
    {
        Log.d("dialog", "onClick: clicked !");
        SigninProcess();
    }
}

