//---------------------------------------------------------------------------

#pragma hdrstop

#include "Lecteurcarte.h"
//---------------------------------------------------------------------------
#pragma package(smart_init)

bool LecteurCarte::Connecter()
{
	bool retour=true;
    //v�rifie si le lecteur est connecté
	if(ReaderOpen())
	{
		retour=false;

	}
	if(GetReaderType(&reader_type))
	{
		retour=false;
	}
	if(GetReaderSerialNumber(&reader_sn))
	{
		retour=false;
	}
	return retour;
}

bool LecteurCarte::Lecturecarte()
{
	bool retour=false;
    // pas de carte devant le lecteur
	if(GetDlogicCardType(&card_type))
	{
        retour=false;
	}
	// format de la carte (1K classic) avec l'heure de passage
	else if(card_type == DL_MIFARE_CLASSIC_1K)
	{
        retour = true;
		supported_card = false;
	}
    //Probl�me d'ID
	if(GetCardIdEx(&old_card_type, card_id,&id_len))
	{
        retour=false;
	}
	if (retour) {
		if(id_len == 7)
		{
			this->card_nr.sprintf("%02X%02X%02X%02X%02X%02X%02X", card_id[0], card_id[1], card_id[2],
						card_id[3], card_id[4], card_id[5], card_id[6]);
		}
		else
		{
			this->card_nr.sprintf("%02X%02X%02X%02X", card_id[0], card_id[1], card_id[2],
						card_id[3]);
		}
	}
	return retour;
	
}
AnsiString LecteurCarte::DonnerCarte()
{
	return this->card_nr;
}

