package com.example.jay.appfillbelly;

import android.content.DialogInterface;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.rengwuxian.materialedittext.MaterialEditText;

public class SignUp extends AppCompatActivity implements View.OnClickListener {

    MaterialEditText edtNewEmail,edtNewName;
    public Button btnSignUp;
    FirebaseDatabase database;
    DatabaseReference users;

    public MaterialEditText getEdtNewEmail() {
        return edtNewEmail;
    }

    public void setEdtNewEmail(MaterialEditText edtNewEmail) {
        this.edtNewEmail = edtNewEmail;
    }

    public MaterialEditText getEdtNewName() {
        return edtNewName;
    }

    public void setEdtNewName(MaterialEditText edtNewName) {
        this.edtNewName = edtNewName;
    }

    public SignUp(String edtNewName, String edtNewEmail) {

    }
    public SignUp()
    {
        //empty
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);

        edtNewName = (MaterialEditText)findViewById(R.id.edtName);
        edtNewEmail = (MaterialEditText)findViewById(R.id.edtEmail);

        btnSignUp = (Button)findViewById(R.id.btnSignUp);

        database  = FirebaseDatabase.getInstance();
        users = database.getReference("Users");



    }

    private void showSignupDialog() {
        AlertDialog.Builder alertDialog = new AlertDialog.Builder(SignUp.this);
        alertDialog.setTitle("SignUp");
        alertDialog.setMessage("Please fill all information....!");

        LayoutInflater inflater  = this.getLayoutInflater();
        View activity_sign_up = inflater.inflate(R.layout.activity_sign_up,null);

        edtNewName = (MaterialEditText)activity_sign_up.findViewById(R.id.edtName);
        edtNewEmail = (MaterialEditText)activity_sign_up.findViewById(R.id.edtEmail);


        alertDialog.setView(activity_sign_up);
        alertDialog.setIcon(R.drawable.ic_account_circle_black_24dp);

        alertDialog.setNegativeButton("NO", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                dialogInterface.dismiss();

            }
        });

        alertDialog.setPositiveButton("YES", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                final SignUp user = new SignUp(edtNewName.getText().toString(),edtNewEmail.getText().toString());

                users.addListenerForSingleValueEvent(new ValueEventListener() {
                    @Override
                    public void onDataChange(DataSnapshot dataSnapshot) {
                        if(dataSnapshot.child(String.valueOf(user.getEdtNewName())).exists())
                            Toast.makeText(SignUp.this, "User already exists", Toast.LENGTH_SHORT).show();
                        else
                        {
                            users.child(String.valueOf(user.getEdtNewName()))
                                    .setValue(user);
                            Toast.makeText(SignUp.this, "Successful registration", Toast.LENGTH_SHORT).show();
                        }
                    }

                    @Override
                    public void onCancelled(DatabaseError databaseError) {

                    }
                });

                dialogInterface.dismiss();
            }
        });

        alertDialog.show();
    }

    @Override
    public void onClick(View view) {
        switch(view.getId())
        {
            case R.id.btnSignUp:
                showSignupDialog();
                break;


        }

    }
}
