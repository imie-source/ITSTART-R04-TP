#include <stdio.h>

/** Fonction demandant les informations globales sur le voyage
 *
 * @param dest Destination du voyage
 * @param prixBasePers Prix de base par personne
 * @param nbPers Nombre de voyageurs
 */
void saisieInfosGlobales(char dest[], float *prixBasePers, int *nbPers) {
	printf("Destination : ");
	scanf("%s", dest);
	printf("Prix de base HT par personne : ");
	scanf("%f", prixBasePers);
	printf("Nombre de personnes : ");
	scanf("%d", nbPers);
}

/** Fonction saisissant les informations personnelles d'un voyageur
 * 
 * @param p Rang de la personne
 * @param nbMoinsDe12 Nombre de personnes de moins de 12 ans
 * @param nbHandicapes Nombre de personnes handicapées
 */
void saisiePersonnalisee(int p, int *nbMoinsDe12, int *nbHandicapes) {
	printf("Personne %d\n", p);
	int moinsDe12 = 0;
	printf("\tEnfant de moins de 12 ans ? (0/1) : ");
	scanf("%d", &moinsDe12);
	if (moinsDe12 == 1) 
		(*nbMoinsDe12)++;
	int handicape = 0;
	printf("\tPersonne handicapee ? (0/1) : ");
	scanf("%d", &handicape);
	if (handicape == 1) 
		(*nbHandicapes)++;	
}

/** Calcule le montant total des remises
 * 
 * @param totalBase Montant total de base
 * @param nbPers Nombre de voyageurs
 * @param prixBasePers Montant d'un billet sans remise
 * @param remise Montant total des remises
 * @param nbMoinsDe12 Nombre d'enfants de moins de 12 ans
 * @param remiseM12 Taux de remise pour un enfant de moins de 12 ans
 * @param totalAvecRemise Montant total HT avec remise
 * @param remiseT4 Taux de remise pour plus de 4 voyageurs
 */
void calculerLesRemises(float *totalBase, int nbPers, float prixBasePers, 
						float *remise, int nbMoinsDe12, float remiseM12,
						float *totalAvecRemise, float remiseT4) {
	*totalBase = nbPers * prixBasePers;
	*remise = nbMoinsDe12 * prixBasePers * remiseM12;
	*totalAvecRemise = *totalBase - *remise;
	if (nbPers >= 4) {
		*totalAvecRemise *= (1 - remiseT4);
		*remise = *totalBase - *totalAvecRemise;
	}
}

/** Calcule le taux de TVA globale (moyenne des TVA)
 * 
 * @param totalTauxGlobalTva Moyenne des TVA
 * @param tvaH Taux de TVA pour personne handicapée
 * @param nbHandicapes Nombre de personnes handicapées
 * @param tva Taux de TVA standard
 * @param nbPers Nombre de voyageurs
 */
void calculerTauxGlobalTVA(float *totalTauxGlobalTva, float tvaH, int nbHandicapes,
							float tva, int nbPers) {
	*totalTauxGlobalTva = ((tvaH * nbHandicapes) + (tva * (nbPers - nbHandicapes))) / nbPers;
}

/** Calcule le montant net à payer
 * 
 * @param netAPayer Montant net à payer
 * @param totalAvecRemise Montant HT avec les remises prises en compte
 * @param totalTauxGlobalTva Moyenne des TVA 
 */
void calculerNetAPayer(float *netAPayer, float totalAvecRemise, float totalTauxGlobalTva) {
	*netAPayer = totalAvecRemise * (1 + totalTauxGlobalTva);
}

/** Affiche la facture avec les montants
 * 
 * @param prixBasePers Prix de base par personne
 * @param totalBase Prix total de base
 * @param remise Montant total des remises
 * @param totalAvecRemise Montant total après remise
 * @param totalTauxGlobalTva Moyenne des TVA
 * @param netAPayer Montant net à payer
 */
void AfficherFacture(float prixBasePers, float totalBase, float remise,
					  float totalAvecRemise, float totalTauxGlobalTva, float netAPayer) {
	printf("Prix billet non remise : %.2f\n", prixBasePers);
	printf("Prix total non remise : %.2f\n", totalBase);
	printf("Total des remises : %.2f\n", remise);
	printf("Prix du voyage avec remise : %.2f\n", totalAvecRemise);
	printf("Montant total TVA : %.2f\n", totalAvecRemise * totalTauxGlobalTva);
	printf("Total net a payer : %.2f\n", netAPayer);
}
	
/** Fonction appelée au démarage du programme.
 *
 * Programme affichant la facture d'un voyage en avion
 * en fonction de différents critères de réduction
 *
 * @author Serge COUDÉ
 * @since 1.0
 * @param argc Nombre d'arguments passés au programme.
 * @param argv Tableau des arguments passés au programme.
 * @return Code retour du programme.
 */
int main(int argc, char *argv[]) {
	
  char dest[50]; // Destination du voyage
  float prixBasePers; // Prix de base HT par personne
  float remiseM12 = 0.5; // Taux de remise pour les - de 12 ans
  float remiseT4 = 0.1; // Taux de remise pour >= 4 personnes
  float tva = 0.2; // Taux de TVA standard
  float tvaH = 0.055; // Taux de TVA pour personne handicapée
  float totalTauxGlobalTva; // Taux global de la TVA sur l'ensemble du billet
  float totalBase; // Montant total si prix de base
  float remise; // Montant total des remises accordées
  float totalAvecRemise; // Montant HT du billet avec les remises appliquées
  float netAPayer; // Montant net à payer
  
  int nbMoinsDe12 = 0; // Nombre d'enfant de moins de 12 ans
  int nbHandicapes = 0; // Nombre de personnes handicapées
  int nbPers = 0; // Nombre de personnes total voyageant
  int moinsDe12; // Booléen : 1 < 12 ans; 0 >= 12 ans
  int handicape; // Booléen : 1 personne handicapée; 0 personne non handicapée
	
  saisieInfosGlobales(dest, &prixBasePers, &nbPers);
  
  int p;
  for(p = 1; p <= nbPers; p++) 
	  saisiePersonnalisee(p, &nbMoinsDe12, &nbHandicapes);
  
  calculerLesRemises(&totalBase, nbPers, prixBasePers, 
					 &remise, nbMoinsDe12, remiseM12,
					 &totalAvecRemise, remiseT4);
  
  calculerTauxGlobalTVA(&totalTauxGlobalTva, tvaH, nbHandicapes,
						tva, nbPers);
  
  calculerNetAPayer(&netAPayer, totalAvecRemise, totalTauxGlobalTva);
  
  AfficherFacture(prixBasePers, totalBase, remise,
				  totalAvecRemise, totalTauxGlobalTva, netAPayer);
  
} 
  
