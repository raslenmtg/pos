$(document).ready(function() {
    var tour = new Tour({
        name: 'tour',
        steps: [],
        template:
            "<div class='popover tour'>" +
            "<div class='arrow'></div>" +
            "<h3 class='popover-title text-bold'></h3>" +
            "<div class='popover-content'></div>" +
            "<div class='popover-navigation'>" +
            "<button class='btn btn-success btn-sm' data-role='prev'>« Précédent</button>&nbsp;" +
            "<button class='btn btn-success btn-sm' data-role='next'>Suivant »</button>" +
            "<button class='btn btn-default btn-sm' data-role='end'>Terminer</button>" +
            "</div></div>",
        orphan: true,
        backdrop: true,
        onEnd: function() {
            $("#side-bar").addClass("tw-overflow-y-auto");
            window.location.href = window.location.href;
        }
    });

    tour.addSteps([

        // ── Étape 1 : Bienvenue ──────────────────────────────────────────────
        {
            element: '#start_tour',
            placement: 'bottom',
            title: 'Bienvenue dans Simplex Gestion !',
            content: 'Ce guide rapide vous présente les principales fonctionnalités de l\'application en <strong>10 étapes</strong>.<br><br>' +
                'Utilisez <em>Suivant</em> pour avancer et <em>Terminer</em> pour quitter à tout moment.',
        },

        // ── Étape 2 : Menu Paramètres (dropdown) ────────────────────────────
        {
            element: '#tour_step3',
            title: 'Étape 1 – Paramètres & Personnalisation',
            content: 'Vous trouverez ici les informations relatives à votre commerce, les informations de base, les méthodes de paiement, les dépôts , les taxes et autres paramètres.',
            onShow: function() {
                if (!$('#tour_step3').hasClass('active')) {
                    $('#tour_step3').trigger('click');
                }
            },
        },

        // ── Étape 3 : Paramètres de l'entreprise (sous-menu) ────────────────
        {
            element: '#tour_step2',
            title: 'Étape 2 – Paramètres de l\'entreprise',
            content: 'Configurez les <strong>informations de base</strong> de votre commerce : <br>' +
                'nom, logo, personnalisation du caisse, paramètres des produit, et les options de personnalisation',
            onShow: function() {
                // Ouvrir d'abord le menu Paramètres si nécessaire
                if (!$('#tour_step3').hasClass('active')) {
                    $('#tour_step3 a:first').trigger('click');
                }
                /*   if (!$('#tour_step2').closest('li').hasClass('active')) {
                       $('#tour_step2').trigger('click');
                   }*/
            },
        },

        // ── Étape 4 : Ressources (taxes, marques, unités, catégories) ────────
        {
            element: '#tour_step5',
            title: 'Étape 3 – Ajouter les ressources',
            content: 'Avant de créer des produits, définissez vos ressources de base: ' +
                '<ol style="margin:6px 0 0 20px;padding:0;list-style-type:decimal;list-style-position:outside;">' +
                '<li style="display:list-item;"><strong>Variations</strong> – définir les variations des produits</li>' +
                '<li style="display:list-item;"><strong>Groupe de prix de vente</strong> – gros, détail </li>' +
                '<li style="display:list-item;"><strong>Unités de mesure</strong> – pièce, carton…</li>' +
                '<li style="display:list-item;"><strong>Catégories</strong> – structurez votre catalogue</li>' +
                '</ol>',
            onShow: function() {
                if (!$('#tour_step5').hasClass('active')) {
                    $('#tour_step5').trigger('click');
                }
            },
        },

        // ── Étape 5 : Contacts (fournisseurs & clients) ──────────────────────
        {
            element: '#tour_step4',
            title: 'Étape 4 – Fournisseurs & Clients',
            content: 'création, importation en masse, groupe client et suivi des soldes et toutes les opérations.',
            onShow: function() {
                if (!$('#tour_step4').hasClass('active')) {
                    $('#tour_step4 a:first').trigger('click');
                }
            },
        },

        // ── Étape 6 : Produits ───────────────────────────────────────────────
        {
            element: '#tour_step5',
            title: 'Étape 5 – Gestion des produits',
            content: 'Ajoutez des produits <strong>simples</strong> ou à <strong>variations</strong> (taille, couleur…): ' +
                '<ul style="margin:6px 0 0 20px;padding:0;list-style-type:disc;list-style-position:outside;">' +
                '<li style="display:list-item;">Prix de vente et prix d\'achat</li>' +
                '<li style="display:list-item;">Stock initial par emplacement</li>' +
                '<li style="display:list-item;">Code-barres et étiquettes à imprimer</li>' +
                '<li style="display:list-item;">Garantie et date d\'expiration</li>' +
                '</ul>',
            onShow: function() {
                if (!$('#tour_step5').hasClass('active')) {
                    $('#tour_step5 a:first').trigger('click');
                }
            },
        },

        // ── Étape 7 : Achats ─────────────────────────────────────────────────
        {
            element: '#tour_step6',
            title: 'Étape 6 – Enregistrez toutes vos achats',
            content: '<ul style="margin:6px 0 0 20px;padding:0;list-style-type:disc;list-style-position:outside;">' +
                '<li style="display:list-item;"><strong>Bons de commande</strong> et demandes d\'achat</li>' +
                '<li style="display:list-item;"><strong>Réceptions de marchandises</strong> avec mise à jour automatique du stock</li>' +
                '<li style="display:list-item;"><strong>Retours fournisseurs</strong></li>' +
                '<li style="display:list-item;">Suivi des paiements dus aux fournisseurs</li>' +
                '</ul>',
            onShow: function() {
                if (!$('#tour_step6').hasClass('active')) {
                    $('#tour_step6 a:first').trigger('click');
                }
            },
        },

        // ── Étape 8 : Ventes ─────────────────────────────────────────────────
        {
            element: '#tour_step7',
            title: 'Étape 7 – Gestion des ventes',
            content:'<ul style="margin:0 0 0 20px;padding:0;list-style-type:disc;list-style-position:outside;">' +
                '<li style="display:list-item;"><strong>Toutes les ventes</strong></li>' +
                '<li style="display:list-item;"><strong>Devis</strong> et brouillons</li>' +
                '<li style="display:list-item;"><strong>Retours clients</strong> et remises</li>' +
                '<li style="display:list-item;">Suivi des <strong>expéditions</strong></li>' +
                '</ul>',
            onShow: function() {
                if (!$('#tour_step7').hasClass('active')) {
                    $('#tour_step7 :first').trigger('click');
                }
            },
        },

        // ── Étape 9 : Caisse POS (bouton panier dans l'en-tête) ──────────────
        {
            element: '#tour_step_pos',
            placement: 'bottom',
            title: 'Étape 8 – Caisse',
            content:
                '<ol style="margin:0 0 0 20px;padding:0;list-style-type:decimal;list-style-position:outside;">' +
                '<li style="margin-bottom:5px;"><i class="bx bx-check-double text-success"></i>  Scannez et encaissez en quelques secondes.</li>' +
                '<li style="margin-bottom:5px;"><i class="bx bx-check-double text-success"></i> <strong>Multi-Paiement :</strong> Espèces, chèque ou virement.</li>' +
                '<li style="margin-bottom:5px;"><i class="bx bx-check-double text-success"></i> <strong>Tickets & Factures :</strong> Impression immédiate pour vos clients.</li>' +
                '</ol>',
        },

        // ── Étape 10 : Rapports ──────────────────────────────────────────────
        {
            element: '#tour_step8',
            title: 'Étape 9 – Rapports & Analyses',
            content:'Consultez des rapports détaillés pour piloter votre activité :' +
                '<ol style="margin:6px 0 0 20px;padding:0;list-style-type:decimal;list-style-position:outside;">' +
                '<li style="display:list-item;"><strong>Profits & Pertes</strong></li>' +
                '<li style="display:list-item;">Rapports de <strong>stock</strong> (niveaux, expiration, ajustements)</li>' +
                '<li style="display:list-item;">Ventes et achats <strong>par produit</strong></li>' +
                '<li style="display:list-item;">Rapports de <strong>taxes</strong> et de <strong>caisse</strong></li>' +
                '<li style="display:list-item;"><strong>Rapports des encaissements</strong> </li>' +
                '</ol>',
            onShow: function() {
                if (!$('#tour_step8').hasClass('active')) {
                    $('#tour_step8 a:first').trigger('click');
                }
            },
        },

    ]);

    $('#start_tour').on('click', function() {
        $("#side-bar").removeClass("tw-overflow-y-auto");
        tour.init();
        tour.restart();
    });

    if ($('#start_tour').length > 0 && localStorage.getItem('upos_app_tour_shown') !== 'true') {
        $('#start_tour').trigger('click');
        localStorage.setItem('upos_app_tour_shown', 'true');
    }
});
