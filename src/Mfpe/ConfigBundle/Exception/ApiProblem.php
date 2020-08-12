<?php

namespace Mfpe\ConfigBundle\Exception;

class ApiProblem
{

    private $statusCode;
    private $message;

    const USER_NOT_EXIST = array('fr' => 'Utilisateur inexistant', 'ar' => 'مستخدم غير موجود');
    const MESSAGE_EXCEPTION = array('fr' => 'Vous ne pouvez pas supprimer cet élément, vous devez supprimer les éléments associés', 'ar' => 'لا يمكنك حذف هذا العنصر ، يجب عليك حذف العناصر المرتبطة.');
    const SPECIALITE_FOUND_PERIODE = array('fr' => 'Citoyen a une demande clôturée ou rejetée avec la même spécialité, il peut renouveler sa demande après le délais', 'ar' => 'المواطن لديه طلب مغلق أو مرفوض بنفس التخصص ، ويمكنه تجديد طلبه بعد الموعد النهائي');
    const SPECIALITE_FOUND = array('fr' => 'Citoyen a une demande en cours avec la même spécialité', 'ar' => 'المواطن لديه طلب حالي بنفس التخصص');
    const NOTIFICATION_DOES_NOT_EXIST= array('fr' => 'Notification inexistante', 'ar' => 'مستخدم غير موجود');
    const WRONG_PASSWORD = array('fr' => 'Nom d\'utilisateur ou mot de passe erroné(s)', 'ar' => 'اسم المستخدم أو كلمة المرور غير صحيحة');
    const GOUVERNORAT_NOT_EXIST = 'Gouvernorat not exist';
    const DEMANDES_DOES_NOT_EXIST = array('fr' => 'Il n\'y a pas de demandes', 'ar' => 'لا توجد مطالب');
    const TYPES_DOES_NOT_EXIST = array('fr' => 'Type n\'existe pas', 'ar' => 'النوع غير موجود');
    const OBJECT_DOES_NOT_EXIST = array('fr' => 'Objet n\'existe pas', 'ar' => 'غير موجود');
    const REGIME_DOES_NOT_EXIST = array('fr' => 'Regime n\'existe pas', 'ar' => 'النظام غير موجود');
    const UNIITE_REGIONAL_DOES_NOT_EXIST = array('fr' => 'Il n\'y a pas d\'unités regionales', 'ar' => 'لا توجد وحدات إقليمية');
    const SPECIALITE_EXISTANTE = array('fr' => 'Il ya une demande avec cette spécialité depuis {delai}  ', 'ar' => ' منذ {delai} هناك طلب مع هذا التخصص');
    const IDENTIFIANT_EXIST_DEJA = array('fr' => 'Identifiant existe déja dans la base  ', 'ar' => 'معرف موجود بالفعل');
    const CIN_EMPTY = array('fr' => 'Numéro de cin est obligatoire', 'ar' => 'تعمير هذا الحقل إجباري');
    const CIN_EQUAL_8 = array('fr' => 'Numéro cin doit comporter 8 chiffres', 'ar' => 'يجب أن يكون رقم بطاقة الهوية 8 أرقام');
    const TEL_EQUAL_8 = array('fr' => 'Numéro téléphone doit comporter 8 chiffres', 'ar' => 'يجب أن يكون رقم الهاتف 8 أرقام');
    const TEL_NUMERIQUE = array('fr' => 'Numéro téléphone doit être numérique', 'ar' => 'يجب أن يكون رقم الهاتف رقميًا');
    const FAX_EQUAL_8 = array('fr' => 'Numéro fax doit comporter 8 chiffres', 'ar' => 'يجب أن يكون رقم الفاكس 8 أرقام');
    const FAX_NUMERIQUE = array('fr' => 'Numéro fax doit être numérique', 'ar' => 'يجب أن يكون رقم الفاكس رقميًا');
    const NATIONALITY_EMPTY = array('fr' => 'Nationalite est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const NATIONALITY_NOT_EXIST = array('fr' => 'Nationalite inexistante', 'ar' => 'تعمير هذا الحقل إجباري');
    const NOM_EMPTY = array('fr' => 'Nom est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const PRENOM_EMPTY = array('fr' => 'Le prenom  est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const DATE_NAISSANCE_EMPTY = array('fr' => 'Date de naissance est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const TEL_EMPTY = array('fr' => 'Téléphone est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const EMAIL_EMPTY = array('fr' => 'Mail est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const SEXE_EMPTY = array('fr' => 'Champ sexe est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const LIEU_NAISSANCE_EMPTY = array('fr' => 'Lieu de naissance est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const PERSONNE_BESOIN_SPECIFIQUE_EMPTY = array('fr' => 'Personne a besoin spécifique est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const NATURE_BESOIN_SPECIFIQUE_EMPTY = array('fr' => 'Nature du besoin spécifique est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const NIVEAU_ETUDE_EMPTY = array('fr' => 'Niveau d\'etude est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const DATE_INSCRIPTION_EMPTY = array('fr' => 'Date d\'inscription est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const CIN_NOT_NUMERIC = array('fr' => 'Numéro de cin doit être numérique', 'ar' => 'يجب أن يكون رقم بطاقة الهوية رقميًا');
    const YEAR_NOT_NUMERIC = array('fr' => 'L\'année doit être numérique', 'ar' => 'السنة يجب أن تكون رقمية ');
    const FIELD_NOT_NUMERIC = array('fr' => 'Le champ doit être numérique', 'ar' => 'الحقل يجب أن تكون رقمي ');
    const YEAR_EQUAL_4 = array('fr' => 'L\'année doit comporter 4 chiffres', 'ar' => 'السنة أيجب أن تتكون من 4 أرقام');
    const INITIAL_NUMBER_NOT_NUMERIC = array('fr' => 'Champ doit être numérique', 'ar' => 'الحقل يجب أن تكون رقمي');
    const CONTINUS_NUMBER_NOT_NUMERIC = array('fr' => 'Champ doit être numérique', 'ar' => 'الحقل يجب أن تكون رقمي');
    const INITIAL_CONTINUS_NUMBER_NOT_NUMERIC = array('fr' => 'Champ doit être numérique', 'ar' => 'الحقل يجب أن تكون رقمي');
    const CHANGE_NUMBER_NOT_NUMERIC = array('fr' => 'Champ doit être numérique', 'ar' => 'الحقل يجب أن تكون رقمي');
    const CLOSED_TTRAINIG_CENTER_NOT_NUMERIC = array('fr' => 'Champ doit être numérique', 'ar' => 'الحقل يجب أن تكون رقمي');
    const PRIVATE_TRAINIG_CENTER_DOES_NOT_EXIST =  array('fr' => 'Centre de formation  n\'existe pas ', 'ar' => 'مركز التكوين الخاص غير موجود ');
    const PROJET_DOES_NOT_EXIST =  array('fr' => 'Projet investissement  n\'existe pas ', 'ar' => 'مشروع استثماري غير موجود ');

    const PRIVATE_FORME_INSCRIT_DOES_NOT_EXIST =  array('fr' => 'Formé inscrit au secteur de la formation  n\'existe pas ', 'ar' => 'المدربين المسجلين في قطاع التدريب غير موجود ');
    const DELAIS_DOES_NOT_EXIST =  array('fr' => 'Delais PV  n\'existe pas ', 'ar' => 'الحدود الزمنية PV غير موجود');
    const SOCIO_ECONOMIC_DATA_DOES_NOT_EXIST =  array('fr' => 'Données socio-economiques  n\'existe pas ', 'ar' => 'البيانات الاجتماعية والاقتصادية غير موجودة ');
    const SOCIO_ECONOMIC_CSV_DOES_NOT_EXIST =  array('fr' => 'File  n\'existe pas ', 'ar' => 'الملف غير موجود ');
    const NUMBER_FIELD_NOT_COMPATIBLE = array('fr' => 'Nombre de champs non compatibles', 'ar' => 'عدد الخانات غير متوافقة');
    const FIELD_LONG = array('fr' => 'Nombre très long', 'ar' => 'عدد طويل جدا');
    const FIELD_NOT_COMPATIBLE = array('fr' => 'Champ doit être de type tableau', 'ar' => ' يجب أن يكون الحقل من نوع مجموعة مصفوفة');

    const PASSPORT_EMPTY = array('fr' => 'Numéro de passport est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const PASSPORT_EQUAL_8 = array('fr' => 'Numéro de passport doit comporter 8 chiffres', 'ar' => 'رقم جواز السفر يجب أن يتكون من 8 أرقام ');
    const DATE_DELIVRANCE_PASSPORT_EMPTY = array('fr' => 'Date de delivrance passport est obligatoire non renseigné', 'ar' => 'تاريخ تسليم جواز السفر إلزامي ، وليس معبأ ');
    const DATE_DELIVRANCE_CIN_EMPTY = array('fr' => 'Date de delivrance CIN est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const FIELD_REQUIRED_IS_EMPTY = array('fr' => 'Champ obligatoire non renseigné', 'ar' => 'خانة فارغة ، يجب تعميرها');
    const PASSWORD_USER_RESET_SUCCESS = array('fr' => 'Mot de passe réinitialisé avec succès', 'ar' => 'إعادة تعمير كلمة المرور بنجاح');
    const PASSWORD_USER_RESET_ECHEC = array('fr' => 'operation échouée', 'ar' => 'شكرا لتصحيح الاخطاء');
    const MESSAGE_GLOBAL = array('fr' => 'Le formulaire n\'est pas valide, merci de corriger les erreurs', 'ar' => 'الاستمارة غير صحيحة ، يرجى تصحيح الأخطاء');
    const ATTESTATION_NOT_EXIST = array('fr' => 'Attestation non existant', 'ar' => 'شهادة غير موجودة');
    const IDENTITY_REGIONAL = array('fr' => 'Identité régionale existe déjà ', 'ar' => 'الهوية الإقليمية موجودة');
    const ROLE_NOT_EDITABLE = array('fr' => 'rôle non modifiable', 'ar' => 'دور غير قابل للتعديل');
    const MESSAGE_GLOBAL_ERREUR = array('fr' => 'Une erreur est survenue', 'ar' => 'حدث خطأ');
    const SPECIALITE_NOT_EXIST = array('fr' => 'Spécialité non existant', 'ar' => 'التخصص غير موجود');
    const STATGRADUATE_NOT_EXIST = array('fr' => 'Statistique Graduate and training does not exist ', 'ar' => 'إحصاء الدراسات العليا والتدريب غير موجود');
    const TOKEN_JWT_EXPIRED = array('fr' => 'Merci de vous reconnecter', 'ar' => 'شكرا لك على إعادة تسجيل الدخول');
    const EMAIL_EXIST_IN_DATABASE = array('fr' => 'Adresse Email déjà existe', 'ar' => 'البريد الإلكتروني موجود ');
    const IDENTIFIANT_EXIST_IN_DATABASE = array('fr' => 'Identifiant  déjà existe', 'ar' => 'المعرف موجود ');
    const UNITE_REGIONAL_EXIST_DEJA = array('fr' => 'Unité régional déja existe ', 'ar' => 'الوحدة الإقليمية موجودة بالفعل ');
    const EMAIL_FALSE = array('fr' => 'Adresse Email n\'est pas valide', 'ar' => 'البريد الإلكتروني خاطئ ');
    const CIN_EXIST_IN_DATABASE = array('fr' => 'Numéro carte CIN existe déjà ', 'ar' => 'رقم بطاقة الهوية موجود ');
    const PASSPORT_EXIST_IN_DATABASE = array('fr' => 'Numéro du passeport existe déjà ', 'ar' => 'رقم جواز السفر موجود ');
    const DEMANDE_NOT_EXIST = array('fr' => 'Demande n\'existe pas ', 'ar' => 'هذا المطلب غير موجود ');
    const DEMANDE_NOT_UPDATE = array('fr' => 'la demande ne peut pas être modifiée ', 'ar' => 'لا يمكن تغيير الطلب ');
    const STATUT_NOT_VALID = array('fr' => 'Status non valide ', 'ar' => 'الحالة غير صالحة ');
    const SEJOUR_EMPTY = array('fr' => 'le numero de séjour est obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const DATE_VALIDITE_SEJOUR_EMPTY = array('fr' => 'la date de validite de séjour est  obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const GOUVERNERAT_EMPTY = array('fr' => 'la gouvernorat est  obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const DELEGATION_EMPTY = array('fr' => 'la délégation  est  obligatoire non renseigné', 'ar' => 'تعمير هذا الحقل إجباري');
    const ACTION_NOT_EXIST = array('fr' => 'L\'action doit être 0 ou 1', 'ar' => 'L\'action doit être 0 ou 1');
    const DATE_NAISSANCE_NOT_VALID = array('fr' => 'Date naissance n\'est pas valide', 'ar' => 'تاريخ الميلاد غير صحيح ');
    const DATE_DELIVRANCE_CIN_NOT_VALID = array('fr' => 'Date de délivrance CIN n\'est pas valide', 'ar' => 'تاريخ إصدار رقم بطاقة الهوية غير صحيح ');
    const DATE_DELIVRANCE_PASSWORT_NOT_VALID = array('fr' => 'Date de délivrance passsport n\'est pas valide', 'ar' => 'تاريخ إصدار رقم جواز السفر غير صحيح ');
    const MONTH_NOT_EXIST = array('fr' => 'Mois non existant', 'ar' => 'الشهر غير موجود');
    const FIELD_NOT_VALID = array('fr' => 'Valeur n\'est pas valide', 'ar' => 'خانة غير صحيحة');
    const ACCESS_FORBIDDEN = array('fr' => 'Accès interdit', 'ar' => 'ممنوع الدخول');
    // IF REFERENCIEL DOES NOT EXIST IN DATABASE
    const NATIONALITY_DOES_NOT_EXIST = array('fr' => 'Nationalité n\'existe pas ', 'ar' => 'نظام مرجعية الجنسية غير موجودة');
    const CARACTERESTIQUE_DOES_NOT_EXIST = array('fr' => 'Caracteristiques region n\'existe pas ', 'ar' => ' خصائص المنطقة غير موجودة');
    const GOUVERNERAT_DOES_NOT_EXIST = array('fr' => 'Gouvernorat n\'existe pas ', 'ar' => 'خانة  الولاية غير موجودة');
    const DELEGATION_DOES_NOT_EXIST = array('fr' => 'Délégation n\'existe pas ', 'ar' => 'خانة  المعتمدية غيرموجودة');
    const LOCALITY_DOES_NOT_EXIST = array('fr' => 'Localité n\'existe pas ', 'ar' => 'خانة   المكان غيرموجودة');
    const MUNICIPALITY_DOES_NOT_EXIST = array('fr' => 'Municipalité n\'existe pas ', 'ar' => 'خانة   البلدية غيرموجودة');
    const DIRECTION_REGIONAL_DOES_NOT_EXIST = array('fr' => 'Direction régionale n\'existe pas ', 'ar' => 'الإدارة الإقليمية غير موجودة');
    const FONCTION_DOES_NOT_EXIST = array('fr' => 'Fonction n\'existe pas ', 'ar' => 'وظيفة غير موجودة');
    const NATURE_BESOIN_SPECIFIQUE_DOES_NOT_EXIST = array('fr' => 'Nature besoin spécifique n\'existe pas ', 'ar' => 'خانة طبيعة حاجة محددة غير موجودة');
    const NIVEAU_ETUDE_DOES_NOT_EXIST = array('fr' => 'Niveau étude n\'existe pas ', 'ar' => 'خانة مستوى الدراسة غير موجودة');
    const NIVEAU_DIPLOME_DOES_NOT_EXIST = array('fr' => 'Niveau diplome n\'existe pas ', 'ar' => 'مستوى الشهادة غير موجود');
    const ROLES_DOES_NOT_EXIST = array('fr' => 'Rôle utilisateur n\'existe pas ', 'ar' => 'دور المستخدم غير موجود');
    const USER_DOES_NOT_EXIST = array('fr' => 'Utilisateur n\'existe pas ', 'ar' => 'المستخدم غير موجود');
    const ORGANISME_DOES_NOT_EXIST = array('fr' => 'Organisme n\'existe pas ', 'ar' => 'منظمة غير موجودة');
    const DATE_EXAMIN_NOT_EXIST = array('fr' => 'Date examen n\'existe pas ', 'ar' => 'تاريخ الامتحان غير موجود');
    const DATE_NOT_VALID = array('fr' => 'Date  n\'est pas valide', 'ar' => 'تاريخ غير صحيح ');
    const SECTEUR_DOES_NOT_EXIST = array('fr' => 'Secteur n\'existe pas ', 'ar' => 'خانة القطاع غير موجودة');
    const SOUS_SECTEUR_DOES_NOT_EXIST = array('fr' => 'Sous secteur n\'existe pas ', 'ar' => 'خانة القطاع الفرعي غير موجود');
    const DOMAINE_DOES_NOT_EXIST = array('fr' => 'Domaine  n\'existe pas ', 'ar' => 'خانة الميدان غير موجودة');
    const JUSTIF_EXPERIENCE_DOES_NOT_EXIST = array('fr' => 'Expériences  n\'existe pas ', 'ar' => 'خانة الخبرة غير موجودة');
    const CENTRE_FORMATION_DOES_NOT_EXIST = array('fr' => 'Centre de formation  n\'existe pas ', 'ar' => 'مركز التكوين غير موجود ');
    const STRUCTURE_NOT_EXIST = array('fr' => 'Structure inexistante ', 'ar' => 'الهيكل غير موجود ');
    const STATUT_DOES_NOT_EXIST = array('fr' => 'Statut  n\'existe pas ', 'ar' => 'الحالة غير موجودة ');
    const NOT_EXTENSION_FILE = array('fr' => 'Le champ n\'est pas de type file', 'ar' => 'الخانة ليست من نوع ملف ');
    const EXTENSION_FILE_NOT_VALID = array('fr' => 'L\'extension du fichier  n\'est pas valide', 'ar' => ' نوع الملف غير صالح');
    const ROLE_DOES_NOT_EXIST = array('fr' => 'Rôle n\'existe pas', 'ar' => 'الدور غير موجود');
    const ROLE_AFFECTED_USER = array('fr' => 'Rôle est affecté à des utilisateurs', 'ar' => 'الدور متصل بمستخدمين');
    const ROLE_EXIST = array('fr' => 'Rôle existe déjà', 'ar' => 'الدور موجود سابقا');
    const DELETED_SUCCESS = array('fr' => 'Suppression avec succès', 'ar' => 'تم الحذف بنجاح');

    const USER_CENTRE_FORMATION_DOES_NOT_EXIST = array('fr' => 'Pas d\'utilisateur affecté à ce Centre de formation', 'ar' => 'لم يتم تعيين مستخدمين لهذا المركز التدريبي ');
    const DELEGATION_NOT_EXIST = 'delegation not exist';
    const SOLEIL_NOT_EXIST = 'soleil not exist';
    const IMSAKIA_NOT_EXIST = 'Imsakia inexistante';
    const LUNE_NOT_EXIST = 'lune not exist';
    const PHASELUNE_NOT_EXIST = 'phase lune  not exist';
    const PRIERE_NOT_EXIST = 'priere  not exist';
    const OBSERVATION_NOT_EXIST = "observation not exist";
    const PREVISION_NOT_EXIST = "prévision not exist";
    const CATEGORIE_NOT_EXIST = array('fr' => 'Catégorie n\'existe pas', 'ar' => 'الفئة غير موجودة ');
    const CODE_NOT_EXIST = array('fr' => 'Code n\'existe pas', 'ar' => 'الرمز غير موجودة ');
    const Region_NOT_EXIST = 'region not exist';
    const PICTOGRAMME_NOT_EXIST = "pictogramme not exist";
    const ECHEANCE_NOT_EXIST = "echeance not exist";
    const PLAGE_NOT_EXIST = "plage not exist";
    const DIRECTION_VENT_NOT_EXIST = " direction du vent not exist";
    const M001 = 'Le paramétrage défini dans le système n’est pas conforme avec la source de données (Fichier d’alimentation)';
    const LOGIN_ERROR = "login erreur";
    const CONNEXION_ERROR = "connexion erreur";
    const DISABLED_USER = array('fr' => 'utilisateur désactivé', 'ar' => 'مستخدم معطل ');
    const VILLE_NOT_EXIST = 'ville not exist';
    const PAY_ETRANGER_NOT_EXIST = ' pays étranger not exist';
    const PAY_MONDE_NOT_EXIST = ' pays monde not exist';
    const Upload_failed = 'Upload failed';
    const SOUS_PROGRAMME_NOT_EXIST = 'Sous-programme inexistant';
    const PROGRAMME_NOT_EXIST = 'Programme inexistant';
    const PROJET_NOT_EXIST = 'Projet inexistant';
    const RESPONSABLE_NOT_EXIST = 'Responsable inexistant';
    const CHEF_PROJET_NOT_EXIST = 'Chef de projet inexistant';
    const MISSION_NOT_EXIST = 'Mission inexistante';
    const REFERNCIEL_NOT_EXIST = 'Référenciel inexistant';
    const REGION_NOT_EXIST = 'region inexistant';
    const REGION_REQUIRED = 'region obligatoire';
    const ACTIVITY_NOT_EXIST = 'Activité inexistante';
    const BUDGET_YEAR_NOT_EXIST = 'Année budgetaire inexistante';
    const OBJECTIF_OPERATIONNEL_NOT_EXIST = 'Objectif opérationnel inexistant';
    const INDICATEUR_OPERATIONNEL_NOT_EXIST = 'Indicateur opérationnel inexistant';
    const USERNAME_REQUIRED = "Nom d'utilisateur obligatoire";
    const PASSWORD_REQUIRED = "Mot de passe obligatoire";
    const SOUS_ACTIVITY_NOT_EXIST = 'Sous-activité inexistante';
    const OBJECTIF_STRATIGIQUE_NOT_EXIST = 'Objectif stratégique inexistant';

    const ORIENTATION_STRATIGIQUE_NOT_EXIST = 'Orientation stratégique inexistante';
    const PERMISSION_DENIDED = "Vous n'êtes pas autorisé à accéder à cette ressource";
    const USERNAME_ALREADY_EXISTS = "Nom d'utilisateur existe déjà";
    const EMAIL_ALREADY_EXISTS = 'Adresse e-mail existe déjà';
    const USER_NOT_FOUND = 'Utilisateur inconnu';
    const STRATEGIC_INDICATOR_NOT_EXIST = 'Indicateur stratégique inexistant';
    const FORMULE_NOT_FOUND = 'Formule inexistante';
    const STRUCTURE_NOT_OPERATIONNEL = "La structure séléctionnée n'est pas de type opérationnel";
    const INDICATEUR_OPERATIONNEL_REQUIRED = 'Indicateur opérationnel obligatoire';
    const NOM_REQUIRED = 'Nom obligatoire';
    const VALEUR_REQUIRED = 'Valeur obligatoire';
    const OPERATEUR_REQUIRED = 'Opérateur obligatoire';
    const FORMULE_INVALIDE = 'Formule invalide';
    const CDMT_NOT_EXIST = "CDMT inexistant";
    const CDMT_NOT_FOUND_BUDGET_YEAR = "Aucun CDMT n'appartient à cette année budgetaire";
    const CDMT_NOT_FOUND_PROGRAMME = "Aucun CDMT n'appartient à ce programme";
    const FOND_SPECIAUX_NOT_EXIST = "Fond speciaux inexistant";
    const DELETE_ERROR = "Vous devez supprimer les enregistrements associés";
    const BUDGET_TITRE1_NOT_EXIST = "Budget titre 1 inexistant";
    const BUDGET_TITRE2_NOT_EXIST = "Budget titre 2 inexistant";
    const ROLE_NOT_EXIST = "Rôle inexistant";
    const PERMISSION_NOT_EXIST = "Permission inexistante";
    const VIGILANCE_NOT_EXIST = "Vigilance inexistante";
    const VIGILANCESAISIPDF_NOT_EXIST = 'La table vigillancezonessaisipdf est vide';
    const SISMOLOGIE_NOT_EXIST = "Sismologie inexistante";
    const COULEUR_NOT_EXIST = 'Le code Couleur est inexistant';
    const HEURE_NOT_EXIST = 'Heure inexistante';
    const FORCE_NOT_EXIST = "Force prevision marine inexistant";
    const VENTDIRECTION_NOT_EXIST = "Direction vent marine inexistant";
    const MER_NOT_EXIST = "Etat Mer Inexistant";
    const DIRECTION_HOULE_NOT_EXIST = "Direction houle inexistant";
    const ZONEMARINE_NOT_EXIST = "Zone marine inexistant";
    const VISIBILITE_NOT_EXIST = "visibilite inexistant";
    const TEMPS_NOT_EXIST = "Temps inexistant";
    const REGION_STATION_NOT_EXIST = "Station not exist";
    const serializerGroups = "ClimatologieGroup";
    const DOCUMENTATION_NOT_EXIST = "documentation not exist";
    const PHENOMENE_NOT_EXIST = "Phénomène Astronomique  inexistant";
    /* Bloc de lecture Radhia */
    const AVIS_NOT_EXIST = "Ref Avis not exist";
    const AVIS_STATUS_NOT_EXIST = "Ref avis status not exist";
    const ZONESTATUS_NOT_EXIST = "Ref zone status not exist";
    const BMS_NOT_EXIST = "Bms not exist";
    const PARAM_NOT_EXIST = "Parametre not exist";
    const CLIMATOLOGIE_NOT_EXIST = "climatologie not exist";
    const TRANSITION_NOT_EXIST = "Transition not exist";
    const TOKEN_NOT_EXIST = 'Token inexistant';
    const TOKEN_NOT_VALIDE = 'Token invalide';
    const TOKEN_EXPIRED = 'Token expiré';
    const ROLE_ALREADY_EXIST = "Rôle existe déjà";
    const PRESENTATION_NOT_EXIST = "Presentation not exist";
    const COMMUNIQUE_NOT_EXIST = "Communique not exist";
    const AVIS_TRANSITION_NOT_EXIST = "Avis transition not exist";
    const TRAINING_NOT_EXIST = "Training not exist";
    const RCCSTATION_NOT_EXIST = "RCC station not exist";
    const File_REQUIRED = "File required";


    /* */
    /* Bloc de lecture Omar */
    const USER_NOT_ENABLED = "User not enabled";
    const PREVISION_TYPE_UNKNOW = "Inconnu paramétre type : 3 paramétres MATIN APM MOYENNE sont autorisées";
    const PREVISION_MARINE_TRANSITION = "Transition not exist";

    /**/

    public function __construct($statusCode, $message)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function toArray()
    {
        return
            [
                'code' => $this->statusCode,
                'message' => $this->message
            ];
    }

}
