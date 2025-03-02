<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* pdf/exercice.html.twig */
class __TwigTemplate_94d0c718097dd220e877baba9fc738e9 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pdf/exercice.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pdf/exercice.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <title>Détails de l'Exercice</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            margin: 30px;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 25px;
            background: linear-gradient(to right, #ffffff, #f8f9fa);
        }
        .header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .section {
            margin-bottom: 35px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .section-title {
            color: #3498db;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ecf0f1;
            text-transform: uppercase;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-radius: 6px;
            overflow: hidden;
        }
        .info-row {
            display: table-row;
            transition: background-color 0.3s;
        }
        .info-row:hover {
            background-color: #f8f9fa;
        }
        .info-label {
            display: table-cell;
            font-weight: 600;
            padding: 12px 15px;
            width: 200px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ecf0f1;
            color: #34495e;
        }
        .info-value {
            display: table-cell;
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
        }
        .tentatives-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 25px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .tentatives-table th,
        .tentatives-table td {
            border: none;
            padding: 15px;
            text-align: left;
        }
        .tentatives-table th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }
        .tentatives-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .tentatives-table tr:hover {
            background-color: #ecf0f1;
        }
        .stats {
            margin: 25px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #3498db;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 13px;
            color: #7f8c8d;
            border-top: 2px solid #ecf0f1;
            padding-top: 25px;
        }
        .success {
            color: #27ae60;
            font-weight: 600;
        }
        .danger {
            color: #e74c3c;
            font-weight: 600;
        }
        @page {
            margin: 40px;
        }
    </style>
</head>
<body>
    <div class=\"header\">
        <h1>Rapport d'Exercice</h1>
        <p>Généré le ";
        // line 132
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "d/m/Y H:i"), "html", null, true);
        yield "</p>
    </div>

    <div class=\"section\">
        <div class=\"section-title\">Informations de l'Exercice</div>
        <div class=\"info-grid\">
            <div class=\"info-row\">
                <div class=\"info-label\">Titre:</div>
                <div class=\"info-value\">";
        // line 140
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 140, $this->source); })()), "titre", [], "any", false, false, false, 140), "html", null, true);
        yield "</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Type:</div>
                <div class=\"info-value\">";
        // line 144
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 144, $this->source); })()), "typeExercice", [], "any", false, false, false, 144), "html", null, true);
        yield "</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Niveau de difficulté:</div>
                <div class=\"info-value\">";
        // line 148
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 148, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 148), "html", null, true);
        yield "</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Note minimale:</div>
                <div class=\"info-value\">";
        // line 152
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 152, $this->source); })()), "noteMinimale", [], "any", false, false, false, 152), "html", null, true);
        yield "/20</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Temps estimé:</div>
                <div class=\"info-value\">";
        // line 156
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 156, $this->source); })()), "tempsEstime", [], "any", false, false, false, 156), "html", null, true);
        yield " minutes</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Type d'exercice:</div>
                <div class=\"info-value\">";
        // line 160
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 160, $this->source); })()), "typeExercice", [], "any", false, false, false, 160), "html", null, true);
        yield "</div>
            </div>
        </div>
    </div>

    ";
        // line 165
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 165, $this->source); })()), "criteresEvaluation", [], "any", false, false, false, 165)) {
            // line 166
            yield "    <div class=\"section\">
        <div class=\"section-title\">Critères d'évaluation</div>
        <p>";
            // line 168
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 168, $this->source); })()), "criteresEvaluation", [], "any", false, false, false, 168), "html", null, true));
            yield "</p>
    </div>
    ";
        }
        // line 171
        yield "
    <div class=\"section\">
        <div class=\"section-title\">Statistiques des Tentatives</div>
        <div class=\"stats\">
            <p><strong>Nombre total de tentatives:</strong> ";
        // line 175
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 175, $this->source); })()), "tentatives", [], "any", false, false, false, 175)), "html", null, true);
        yield "</p>
            <p><strong>Taux de réussite:</strong> 
                ";
        // line 177
        $context["successCount"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 177, $this->source); })()), "tentatives", [], "any", false, false, false, 177), function ($__t__) use ($context, $macros) { $context["t"] = $__t__; return (CoreExtension::getAttribute($this->env, $this->source, (isset($context["t"]) || array_key_exists("t", $context) ? $context["t"] : (function () { throw new RuntimeError('Variable "t" does not exist.', 177, $this->source); })()), "score", [], "any", false, false, false, 177) >= CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 177, $this->source); })()), "noteMinimale", [], "any", false, false, false, 177)); }));
        // line 178
        yield "                ";
        $context["successRate"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 178, $this->source); })()), "tentatives", [], "any", false, false, false, 178)) > 0)) ? (Twig\Extension\CoreExtension::round((((isset($context["successCount"]) || array_key_exists("successCount", $context) ? $context["successCount"] : (function () { throw new RuntimeError('Variable "successCount" does not exist.', 178, $this->source); })()) / Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 178, $this->source); })()), "tentatives", [], "any", false, false, false, 178))) * 100), 2)) : (0));
        // line 179
        yield "                <span class=\"";
        yield ((((isset($context["successRate"]) || array_key_exists("successRate", $context) ? $context["successRate"] : (function () { throw new RuntimeError('Variable "successRate" does not exist.', 179, $this->source); })()) >= 50)) ? ("success") : ("danger"));
        yield "\">
                    ";
        // line 180
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["successRate"]) || array_key_exists("successRate", $context) ? $context["successRate"] : (function () { throw new RuntimeError('Variable "successRate" does not exist.', 180, $this->source); })()), "html", null, true);
        yield "%
                </span>
            </p>
            ";
        // line 183
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 183, $this->source); })()), "tentatives", [], "any", false, false, false, 183)) > 0)) {
            // line 184
            yield "                ";
            $context["avgScore"] = (Twig\Extension\CoreExtension::reduce($this->env, Twig\Extension\CoreExtension::map($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 184, $this->source); })()), "tentatives", [], "any", false, false, false, 184), function ($__t__) use ($context, $macros) { $context["t"] = $__t__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["t"]) || array_key_exists("t", $context) ? $context["t"] : (function () { throw new RuntimeError('Variable "t" does not exist.', 184, $this->source); })()), "score", [], "any", false, false, false, 184); }), function ($__sum__, $__score__) use ($context, $macros) { $context["sum"] = $__sum__; $context["score"] = $__score__; return ((isset($context["sum"]) || array_key_exists("sum", $context) ? $context["sum"] : (function () { throw new RuntimeError('Variable "sum" does not exist.', 184, $this->source); })()) + (isset($context["score"]) || array_key_exists("score", $context) ? $context["score"] : (function () { throw new RuntimeError('Variable "score" does not exist.', 184, $this->source); })())); }) / Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 184, $this->source); })()), "tentatives", [], "any", false, false, false, 184)));
            // line 185
            yield "                <p><strong>Score moyen:</strong> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((isset($context["avgScore"]) || array_key_exists("avgScore", $context) ? $context["avgScore"] : (function () { throw new RuntimeError('Variable "avgScore" does not exist.', 185, $this->source); })()), 2), "html", null, true);
            yield "/100</p>
            ";
        }
        // line 187
        yield "        </div>
    </div>

    ";
        // line 190
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 190, $this->source); })()), "tentatives", [], "any", false, false, false, 190)) > 0)) {
            // line 191
            yield "    <div class=\"section\">
        <div class=\"section-title\">Liste des Tentatives</div>
        <table class=\"tentatives-table\">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Date</th>
                    <th>Score</th>
                    <th>Note</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 204
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 204, $this->source); })()), "tentatives", [], "any", false, false, false, 204));
            foreach ($context['_seq'] as $context["_key"] => $context["tentative"]) {
                // line 205
                yield "                <tr>
                    <td>";
                // line 206
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "user", [], "any", false, false, false, 206), "email", [], "any", false, false, false, 206), "html", null, true);
                yield "</td>
                    <td>";
                // line 207
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "date", [], "any", false, false, false, 207), "d/m/Y H:i"), "html", null, true);
                yield "</td>
                    <td>";
                // line 208
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "score", [], "any", false, false, false, 208), "html", null, true);
                yield "/100</td>
                    <td>";
                // line 209
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "note", [], "any", false, false, false, 209), "html", null, true);
                yield "/20</td>
                    <td>";
                // line 210
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "statue", [], "any", false, false, false, 210), "html", null, true);
                yield "</td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tentative'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 213
            yield "            </tbody>
        </table>
    </div>
    ";
        }
        // line 217
        yield "
    <div class=\"footer\">
        <p>DevSphere - Plateforme d'apprentissage</p>
        <p>Ce document est généré automatiquement et ne nécessite pas de signature.</p>
    </div>
</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pdf/exercice.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  345 => 217,  339 => 213,  330 => 210,  326 => 209,  322 => 208,  318 => 207,  314 => 206,  311 => 205,  307 => 204,  292 => 191,  290 => 190,  285 => 187,  279 => 185,  276 => 184,  274 => 183,  268 => 180,  263 => 179,  260 => 178,  258 => 177,  253 => 175,  247 => 171,  241 => 168,  237 => 166,  235 => 165,  227 => 160,  220 => 156,  213 => 152,  206 => 148,  199 => 144,  192 => 140,  181 => 132,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <title>Détails de l'Exercice</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            margin: 30px;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 25px;
            background: linear-gradient(to right, #ffffff, #f8f9fa);
        }
        .header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .section {
            margin-bottom: 35px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .section-title {
            color: #3498db;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ecf0f1;
            text-transform: uppercase;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-radius: 6px;
            overflow: hidden;
        }
        .info-row {
            display: table-row;
            transition: background-color 0.3s;
        }
        .info-row:hover {
            background-color: #f8f9fa;
        }
        .info-label {
            display: table-cell;
            font-weight: 600;
            padding: 12px 15px;
            width: 200px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ecf0f1;
            color: #34495e;
        }
        .info-value {
            display: table-cell;
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
        }
        .tentatives-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 25px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .tentatives-table th,
        .tentatives-table td {
            border: none;
            padding: 15px;
            text-align: left;
        }
        .tentatives-table th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }
        .tentatives-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .tentatives-table tr:hover {
            background-color: #ecf0f1;
        }
        .stats {
            margin: 25px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #3498db;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 13px;
            color: #7f8c8d;
            border-top: 2px solid #ecf0f1;
            padding-top: 25px;
        }
        .success {
            color: #27ae60;
            font-weight: 600;
        }
        .danger {
            color: #e74c3c;
            font-weight: 600;
        }
        @page {
            margin: 40px;
        }
    </style>
</head>
<body>
    <div class=\"header\">
        <h1>Rapport d'Exercice</h1>
        <p>Généré le {{ \"now\"|date(\"d/m/Y H:i\") }}</p>
    </div>

    <div class=\"section\">
        <div class=\"section-title\">Informations de l'Exercice</div>
        <div class=\"info-grid\">
            <div class=\"info-row\">
                <div class=\"info-label\">Titre:</div>
                <div class=\"info-value\">{{ exercice.titre }}</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Type:</div>
                <div class=\"info-value\">{{ exercice.typeExercice }}</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Niveau de difficulté:</div>
                <div class=\"info-value\">{{ exercice.niveauDifficulte }}</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Note minimale:</div>
                <div class=\"info-value\">{{ exercice.noteMinimale }}/20</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Temps estimé:</div>
                <div class=\"info-value\">{{ exercice.tempsEstime }} minutes</div>
            </div>
            <div class=\"info-row\">
                <div class=\"info-label\">Type d'exercice:</div>
                <div class=\"info-value\">{{ exercice.typeExercice }}</div>
            </div>
        </div>
    </div>

    {% if exercice.criteresEvaluation %}
    <div class=\"section\">
        <div class=\"section-title\">Critères d'évaluation</div>
        <p>{{ exercice.criteresEvaluation|nl2br }}</p>
    </div>
    {% endif %}

    <div class=\"section\">
        <div class=\"section-title\">Statistiques des Tentatives</div>
        <div class=\"stats\">
            <p><strong>Nombre total de tentatives:</strong> {{ exercice.tentatives|length }}</p>
            <p><strong>Taux de réussite:</strong> 
                {% set successCount = exercice.tentatives|filter(t => t.score >= exercice.noteMinimale)|length %}
                {% set successRate = exercice.tentatives|length > 0 ? (successCount / exercice.tentatives|length * 100)|round(2) : 0 %}
                <span class=\"{{ successRate >= 50 ? 'success' : 'danger' }}\">
                    {{ successRate }}%
                </span>
            </p>
            {% if exercice.tentatives|length > 0 %}
                {% set avgScore = exercice.tentatives|map(t => t.score)|reduce((sum, score) => sum + score) / exercice.tentatives|length %}
                <p><strong>Score moyen:</strong> {{ avgScore|round(2) }}/100</p>
            {% endif %}
        </div>
    </div>

    {% if exercice.tentatives|length > 0 %}
    <div class=\"section\">
        <div class=\"section-title\">Liste des Tentatives</div>
        <table class=\"tentatives-table\">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Date</th>
                    <th>Score</th>
                    <th>Note</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                {% for tentative in exercice.tentatives %}
                <tr>
                    <td>{{ tentative.user.email }}</td>
                    <td>{{ tentative.date|date('d/m/Y H:i') }}</td>
                    <td>{{ tentative.score }}/100</td>
                    <td>{{ tentative.note }}/20</td>
                    <td>{{ tentative.statue }}</td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
    {% endif %}

    <div class=\"footer\">
        <p>DevSphere - Plateforme d'apprentissage</p>
        <p>Ce document est généré automatiquement et ne nécessite pas de signature.</p>
    </div>
</body>
</html>
", "pdf/exercice.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\pdf\\exercice.html.twig");
    }
}
