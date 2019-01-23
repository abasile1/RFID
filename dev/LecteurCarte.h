//---------------------------------------------------------------------------

#ifndef LecteurcarteH
#define LecteurcarteH
#include <System.hpp>
#include "ufCoder.h"
#include <windows.h>


class LecteurCarte{

	private:
			uint32_t reader_type, reader_sn;
			unsigned long dll_ver;
			unsigned char dll_major_ver;
			unsigned char dll_minor_ver;
			unsigned short dll_build;
			unsigned char id_len, i;
			unsigned char card_id[10];
			AnsiString card_nr;
			bool supported_card;
			unsigned char old_card_type;
			unsigned char card_type;
	public:
		//se connecte et renvoie true si le lecteur est connecter et false si non connecter
		bool Connecter();
		// lit une carte renvoie true si une carte est présente false si pas de carte
		bool Lecturecarte();
		//donne le code de la derniere carte scanner
		AnsiString DonnerCarte();
};
//---------------------------------------------------------------------------
#endif
