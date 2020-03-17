shinyUI(pageWithSidebar(
  headerPanel("Upload Result File for Analysis"),
  
  sidebarPanel(
    helpText("This app is shows how a user can update a csv file from their own hard drive for instant analysis.
             In the default case, it uses standard format school marks that could be used by many teachers
             Any file can be uploaded but analysis is only available
             if the data is in same format as the sample file, downloadable below
             ",background = "orange"),
    a("student Marks", href="http://dl.dropbox.com/u/25945599/scores.csv"),
    tags$hr(),
    fileInput('file1', 'Choose Result File of CSV file format',
              accept=c('text/csv', 'text/comma-separated-values,text/plain')),
    
    tags$head(tags$style(type="text/css",
                         "label.radio { display: inline-block; margin:0 10 0 0;  }",
                         ".radio input[type=\"radio\"] { float: none; }")),
    textInput("sheetname",label=h5("Enter sheet name(classsemyear)")),
    actionButton("save", "Save"),
    width=3
    ),
  
  mainPanel(
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
               value = 1)  
      
      
      
      
      
      
      
    )
    
  )
  ))