shinyUI(pageWithSidebar(
  headerPanel(""),
  
  sidebarPanel(
    helpText("This app is shows how a user can update a csv file from their own hard drive for instant analysis.
             In the default case, it uses standard format school marks that could be used by many teachers
             Any file can be uploaded but analysis is only available
             if the data is in same format as the sample file, downloadable below
             ",background = "orange"),
    a("student Marks", href="http://dl.dropbox.com/u/25945599/scores.csv"),
    tags$hr(),
   
    
    #tags$head(tags$style(type="text/css",
    #                     "label.radio { display: inline-block; margin:0 10 0 0;  }",
   #                      ".radio input[type=\"radio\"] { float: none; }")),
    #textInput("sheetname",label=h5("Enter sheet name(classsemyear)")),
   #actionButton("save", "Save")
   width=3
    ),
  
  mainPanel( fileInput('file1', 'Choose Result File of CSV file format',
                       accept=c('text/csv', 'text/comma-separated-values,text/plain')),
    tabsetPanel(
      tabPanel("Student Marks",
               h4(textOutput("caption1")),
               #  checkboxInput(inputId = "pageable", label = "Pageable",value=TRUE),
               #conditionalPanel("input.pageable==true",
               numericInput(inputId = "pagesize",
                            label = "Rows per page",value=13,min=1,max=25),
               
               htmlOutput("raw"),
               radioButtons('filter', 'Select Filter',
                            c(All='a',
                              Distinction='d',
                              Firstclass='f',
                              HigherSecondclass='h',
                              Secondclass='s',
                              Passclass='p',
                              fail='fail'
                              
                            ),
                            inline = TRUE,
                            'All'),
               value = 1),
      tabPanel("Term Details",
               
               
               radioButtons('ss', 'Type',
                            c(Graph='g',
                              Histogram='h'
                            ),
                            inline = TRUE,
                            'Graph'),
               uiOutput("dropoptions"),
               plotlyOutput("density"),
               h4(textOutput("caption2")),
               plotlyOutput("chart"),
               
               htmlOutput("notes2"),
               htmlOutput("newtable"),
               radioButtons('filter2', 'Select Filter',
                            c(All='a',
                              Distinction='d',
                              Firstclass='f',
                              HigherSecondclass='h',
                              Secondclass='s',
                              Passclass='p',
                              fail='fail'
                              
                            ),
                            inline = TRUE,
                            'All'),
               
               value = 2),
      tabPanel("Student Performance",
               #tabPanel(           a("Student Performance", href="sss.html", target="_blank") ,
               h4(textOutput("caption3")),
               radioButtons('ch', 'Select Parameter',
                            c(Roll='r',
                              Name='n'
                            ),
                            inline = TRUE,
                            'Roll'),
               textInput("c", "Search", "",placeholder = "Enter Name or Roll Number"),
               
               plotlyOutput("performance", height="250px"),
               
               htmlOutput("performancetable"),
               
               
               # plotOutput("performance", height="250px"),
               #h4(textOutput("caption4")),
               #verbatimTextOutput("sexDiff"),
               #  uiOutput('markdown'),
               # htmlOutput("notes3"),
               value = 3),
      
      
      
      # tabPanel("r",
      #  h4(textOutput("caption3")),
      # uiOutput('markdown'),
      # htmlOutput("notes3"),
      #value = 4),
      #rmarkdown::render("server.R"),
      # rmarkdown::render("server.R", "pdf_document"),
      tabPanel("Report",
               h4(textOutput("textall")),
               radioButtons('rr', 'Type',
                            c(Graph='g',
                              Histogram='h'
                            ),
                            inline = TRUE,
                            'Graph'),
               plotOutput("reportall"),
               
               plotlyOutput("allchart"),
               #htmlOutput("notes2"),
               
               textOutput("repend"),
               #htmlOutput("notes3"),
               actionButton(inputId='aaa', label="View text report", 
                            icon = icon("tu"), 
                            onclick ="window.open('http://localhost:8080/analysis/report3.php')"),
               #tabPanel("NewPage",
               # includeHTML("report.html"),
               value = 5 ),
      
      
      tabPanel("Prediction",
               
              # actionButton("train", "Train Model"),
              htmlOutput("predict"),
              
              actionButton(inputId="pie",label="Generate Pie Chart"),
               plotlyOutput("count"),
               value = 6 )
      
      
      
      
      
    )
    
  )
  ))