﻿//---------------------------------------------------------------------------

#include <vcl.h>
#pragma hdrstop

#include "ihm.h"
//---------------------------------------------------------------------------
#pragma package(smart_init)
#pragma resource "*.dfm"
TForm1 *Form1;
//---------------------------------------------------------------------------
__fastcall TForm1::TForm1(TComponent* Owner)
	: TForm(Owner)
{
	this->RFID= new LecteurCarte;
}

void __fastcall TForm1::IdTCPServer1Connect(TIdContext *AContext){

	// Affichage en cas de connexion établie
	this->MemoInfoTcp->Lines->Add("TCP Client connecté");
	this->Voyant->Brush->Color = clLime;
}
//---------------------------------------------------------------------------

void __fastcall TForm1::IdTCPServer1Disconnect(TIdContext *AContext){

	// Affichage en cas de connexion non établie
	this->MemoInfoTcp->Lines->Add("TCP Client déconnecté");
	this->Voyant->Brush->Color = clRed;
}
//---------------------------------------------------------------------------

void __fastcall TForm1::IdTCPServer1Execute(TIdContext *AContext){

	// Lancer connexion RFID
	if (AContext->Connection->Socket->ReadChar()=='1'){

		// Lecteur RFID connecté: demander lecture de carte sinon afficher une erreur
		if (this->RFID->Connecter()){

			// Si LectureRFID renvoit True: on demande d'afficher lid de la carte sinon en affiche NO CARTE
			if (this->RFID->Lecturecarte()){

				AContext->Connection->Socket->WriteLn(this->RFID->DonnerCarte());
			}
			else
			{

				AContext->Connection->Socket->WriteLn("NO CARTE");
			}
		}
		else
		{
			AContext->Connection->Socket->WriteLn("erreur");
        }

	}
}
//---------------------------------------------------------------------------
